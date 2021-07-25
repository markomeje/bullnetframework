# A CSRF protection middleware

[![Latest Version on Packagist](https://img.shields.io/github/release/selective-php/csrf.svg)](https://github.com/selective-php/csrf/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Build Status](https://github.com/selective-php/csrf/workflows/build/badge.svg)](https://github.com/selective-php/csrf/actions)
[![Code Coverage](https://scrutinizer-ci.com/g/selective-php/csrf/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/selective-php/csrf/code-structure/master/code-coverage)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/selective-php/csrf/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/selective-php/csrf/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/selective-php/csrf.svg)](https://packagist.org/packages/selective/csrf/stats)

**Important**: Since PHP 7.3+ it's possible to send [SameSite cookies](https://web.dev/samesite-cookies-explained). This makes CSRF prevention techniques obsolete. Further details can be found here: [Sending SameSite cookies in PHP](https://gist.github.com/selective/87d16795f368c48757a1b08da5bd9899)

## Requirements

* PHP 7.1+

## Installation

```
composer require selective/csrf
```

### Slim 4 integration

1. Step: Register the middleware container entry

```php
<?php

use Selective\Csrf\CsrfMiddleware;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\StreamFactory;

// ...

return [
    // ...

    // Register the stream factory container entry
    StreamFactoryInterface::class => function (ContainerInterface $container) {
         return new StreamFactory();
    },

    // Register the middleware container entry
    CsrfMiddleware::class => function (ContainerInterface $container) {
        $streamFactory = $container->get(StreamFactoryInterface::class);

        // Get salt from settings
        $salt = $container->get('settings')['session']['salt'];

        $csrf = new CsrfMiddleware($streamFactory, $salt);

        // Set session id
        // The session must be started before you can get the session id
        $csrf->setSessionId(session_id());

        return $csrf;
    },
];
```

2. Step: Add the middleware

```php
<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Selective\Csrf\CsrfMiddleware;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

// ...

$app->add(CsrfMiddleware::class); // <--- here

// Optional: Session starter middleware
$app->add(function (ServerRequestInterface $request, RequestHandlerInterface $handler) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    return $handler->handle($request);
});

// ...
```

### Using the Aura.Session token

If you are already using the [Aura.Session](https://github.com/auraphp/Aura.Session)
library you can use their Session-ID and CSRF token.

```php
<?php

use Aura\Session\Session;
use Aura\Session\SessionFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Selective\Csrf\CsrfMiddleware;
use Slim\Psr7\Factory\StreamFactory;

// ...

return [
    // ...
    StreamFactoryInterface::class => function () {
         return new StreamFactory();
    },

    Session::class => function () {
        return (new SessionFactory())->newInstance($_COOKIE);
    }

    CsrfMiddleware::class => function (ContainerInterface $container) {
        $streamFactory = $container->get(StreamFactoryInterface::class);

        // Get salt from settings
        $salt = $container->get('settings')['session']['salt'];
    
        $csrf = new CsrfMiddleware($streamFactory, $salt);
        
        // Get Aura session instance
        $session = $container->get(Session::class);
    
        // Use the session from the aura session object
        $csrf->setSessionId($session->getId());

        // Use the token from the aura session object
        $csrf->setToken($session->getCsrfToken()->getValue();
    
        return $csrf;
    }
];
```

## Options

For security reasons all security related settings are enabled by default.

```php
// Set session id from the request
$csrf->setSessionId('...');

// Set a secret salt to increase the security of the token
$csrf->setSalt('secret');

// Change the name of the hidden input field
$csrf->setTokenName('__token');

// Enable jQuery ajax protection against CSRF attacks
$csrf->protectJqueryAjax(true);

// Enable form protection against CSRF attacks
$csrf->protectForms(true);

// Enable form protection against CSRF attacks, but disable GET forms from protection
$csrf->protectForms(true, false);
```

## Rendering the CSRF field in Twig

Sometimes you want a variable to be accessible to all the templates you use.
This is possible inside your `config/container.php` file:

```php
<?php

use League\Container\Container;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;
use Selective\Csrf\CsrfMiddleware;

//...

$container->share(Twig::class, function (Container $container) {
    $loader = new FilesystemLoader('templates');
    $twig = new Twig($loader);

    // Add CSRF token as global template variable
    $csrfToken = $container->get(CsrfMiddleware::class)->getToken();
    $twig->addGlobal('csrf_token', $csrfToken);

    return $twig;
})->addArgument($container);
```

Now, the variable `csrf_token` is available in all Twig templates:

```twig
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf_token" content="{{ csrf_token }}">
    </head>
    <body>
    </body>
</html>
```

## Known issues

> CSRF middleware failed. SessionId not found!

Make sure that the PHP session is already started before invoking the CSRF middleware.

## What attack does anti-forgery prevent?

Cross-site request forgery (also known as XSRF or CSRF, pronounced see-surf) is an attack against web-hosted applications whereby a malicious web site can influence the interaction between a client browser and a web site that trusts that browser. These attacks are made possible because web browsers send some types of authentication tokens automatically with every request to a web site. This form of exploit is also known as a one-click attack or as session riding, because the attack takes advantage of the user's previously authenticated session.

An example of a CSRF attack:

1. A user logs into www.example.com, using forms authentication.
2. The server authenticates the user and issues a response that includes an authentication cookie.
3. The user visits a malicious site.
4. The malicious site contains an HTML form similar to the following:

```html
<h1>You Are a Winner!</h1>
<form action="http://example.com/api/account" method="post">
    <input type="hidden" name="Transaction" value="withdraw" />
    <input type="hidden" name="Amount" value="1000000" />
    <input type="submit" value="Click Me"/>
</form>
 ```

Notice that the form action posts to the vulnerable site, not to the malicious site. This is the “cross-site” part of CSRF.

The user clicks the submit button. The browser includes the authentication cookie with the request. The request runs on the server with the user’s authentication context, and can do anything that an authenticated user is allowed to do.

So basically, when example.com receives the CSRF attack it should match the CSRF token in the cookie against the one in the post data, http header or meta tag. A legit request will include both, however, a forgery attack will only include the CSRF token specified in the cookie.

Session and authentication does not protect against CSRF attack. Developers must implement CSRF protection by themselves.

Using SSL does not prevent a CSRF attack, the malicious site can send an `https://` request.

Note: This library does not protect your applications that change state with `GET` requests and is therefore vulnerable to such malicious attacks.

Users can guard against CSRF vulnerabilities by:

* Logging off of web sites when they have finished using them.
* Clearing their browser's cookies periodically.

However, CSRF vulnerabilities are fundamentally a problem with the web app, not the end user.

More informations:

* [Robust Defenses for Cross-Site Request Forgery](http://seclab.stanford.edu/websec/csrf/csrf.pdf) (pdf)
* [Preventing Cross-Site Request Forgery (XSRF/CSRF) Attacks](https://docs.microsoft.com/en-us/aspnet/core/security/anti-request-forgery)

## How does selective/csrf address CSRF?

### HTML forms

The middleware injects anti-forgery tokens for HTML form elements.

For example, the following HTML file will automatically generate anti-forgery tokens:

```html
<form method="post">
  <!-- form markup -->
</form>
```

Result:

```html
<form method="post">
   <input type="hidden" name="__token" value="the-csrf-token">
  <!-- form markup -->
</form>
```

You can disable automatic generation of anti-forgery tokens for HTML form elements by:

```php
$csrf->protectForms(false);
```

### JavaScript, AJAX, and SPAs

In traditional HTML-based applications, antiforgery tokens are passed to the server using hidden form fields. In modern JavaScript-based apps and single page applications (SPAs), many requests are made programmatically. These AJAX requests may use other techniques (such as request headers or cookies) to send the token. If cookies are used to store authentication tokens and to authenticate API requests on the server, then CSRF will be a potential problem. However, if local storage is used to store the token, CSRF vulnerability may be mitigated, since values from local storage are not sent automatically to the server with every new request. Thus, using local storage to store the antiforgery token on the client and sending the token as a request header is a recommended approach.

### jQuery

The middleware injects a small piece of JavaScript into your html template to protect all jQuery Ajax request against CSRS attacks.

The default header name is: `X-CSRF-TOKEN` (compatible with Angular)

For example, the following HTML file will automatically generate anti-forgery tokens:

```html
<!DOCTYPE html>
    <head>
       <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    </head>
    <body>
    </body>
</html>
```

Result:

```html
<!DOCTYPE html>
    <head>
       <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    </head>
    <body>
    <script>$.ajaxSetup({beforeSend: function (xhr) { xhr.setRequestHeader("X-CSRF-Token","the-csrf-token"); }});</script>
    </body>
</html>
```

You can disable automatic generation of anti-forgery tokens for HTML documents by calling:

```php
$csrf->protectjQueryAjax(false);
```

### Similar libraries

* https://github.com/slimphp/Slim-Csrf
