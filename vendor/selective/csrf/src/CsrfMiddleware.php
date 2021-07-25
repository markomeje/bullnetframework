<?php

namespace Selective\Csrf;

use Selective\Csrf\Exception\CsrfMiddlewareException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * CSRF protection PSR-15 middleware.
 */
final class CsrfMiddleware implements MiddlewareInterface
{
    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * @var string
     */
    private $name = '__token';

    /**
     * @var string
     */
    private $sessionId;

    /**
     * @var string
     */
    private $salt = '';

    /**
     * @var string
     */
    private $token;

    /**
     * @var bool
     */
    private $protectForms = true;

    /**
     * @var bool
     */
    private $protectJqueryAjax = true;

    /**
     * The constructor.
     *
     * @param StreamFactoryInterface $streamFactory The stream factory
     * @param string $salt The salt
     */
    public function __construct(StreamFactoryInterface $streamFactory, string $salt)
    {
        $this->streamFactory = $streamFactory;
        $this->setSalt($salt);
    }

    /**
     * Invoke middleware.
     *
     * @param ServerRequestInterface $request The request
     * @param RequestHandlerInterface $handler The handler
     *
     * @return ResponseInterface The response
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $tokenValue = $this->getToken();

        $this->validate($request, $tokenValue);

        // Attach Request Attributes
        $request = $request->withAttribute('csrf_token', $tokenValue);

        /* @var Response $response */
        $response = $handler->handle($request);

        return $this->injectTokenToResponse($response, $tokenValue);
    }

    /**
     * Set session id.
     *
     * @param string $sessionId The session id
     *
     * @throws CsrfMiddlewareException
     *
     * @return void
     */
    public function setSessionId(string $sessionId): void
    {
        if (empty($sessionId)) {
            throw new CsrfMiddlewareException('CSRF middleware failed. SessionId not found!');
        }

        $this->sessionId = $sessionId;
    }

    /**
     * Set salt.
     *
     * @param string $salt The salt
     *
     * @return void
     */
    public function setSalt(string $salt): void
    {
        if (empty($salt)) {
            throw new CsrfMiddlewareException('CSRF middleware failed. Token must not be empty!');
        }
        $this->salt = $salt;
    }

    /**
     * Set token manually.
     *
     * @param string $token The token
     *
     * @return void
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * Set token name.
     *
     * @param string $name The name
     *
     * @return void
     */
    public function setTokenName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Enable automatic form protection.
     *
     * @param bool $enabled Enable form protection
     *
     * @return void
     */
    public function protectForms(bool $enabled): void
    {
        $this->protectForms = $enabled;
    }

    /**
     * Enable automatic jQuery ajax requests.
     *
     * @param bool $enabled Enable jQuery ajax protection
     *
     * @return void
     */
    public function protectJqueryAjax(bool $enabled): void
    {
        $this->protectJqueryAjax = $enabled;
    }

    /**
     * Get CSRF token.
     *
     * @return string The token
     */
    public function getToken(): string
    {
        if (!empty($this->token)) {
            return $this->token;
        }

        return hash('sha256', $this->sessionId . $this->salt);
    }

    /**
     * Validate token.
     *
     * @param ServerRequestInterface $request The request
     * @param string $tokenValue The token value
     *
     * @throws CsrfMiddlewareException If invalid token is given
     *
     * @return bool Success
     */
    private function validate(ServerRequestInterface $request, string $tokenValue): bool
    {
        // Validate POST, PUT, DELETE, PATCH requests
        $method = $request->getMethod();
        if (!in_array($method, ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            return true;
        }

        $postData = (array)$request->getParsedBody();

        $requestCsrfToken = null;
        if (isset($postData[$this->name])) {
            $requestCsrfToken = $postData[$this->name];
        }
        if (!$requestCsrfToken) {
            // Reads the value and adds it to the request as the X-XSRF-TOKEN header.
            $headers = $request->getHeader('X-CSRF-Token');
            $requestCsrfToken = reset($headers);
        }

        if ($requestCsrfToken !== $tokenValue) {
            throw new CsrfMiddlewareException(
                'CSRF middleware failed. Invalid CSRF token. This looks like a cross-site request forgery.'
            );
        }

        return true;
    }

    /**
     * Inject token to response object.
     *
     * @param ResponseInterface $response The response
     * @param string $tokenValue The token value
     *
     * @return ResponseInterface the response
     */
    private function injectTokenToResponse(ResponseInterface $response, string $tokenValue): ResponseInterface
    {
        // Check if response is html
        $contentTypes = $response->getHeader('content-type');
        $contentType = reset($contentTypes) ?: '';
        if (strpos($contentType, 'text/html') === false) {
            return $response;
        }

        $content = $response->getBody()->__toString();

        if ($this->protectForms) {
            $content = $this->injectFormHiddenFieldToResponse($content, $tokenValue);
        }

        if ($this->protectJqueryAjax) {
            $content = $this->injectJqueryToResponse($content, $tokenValue);
        }

        return $response->withBody($this->streamFactory->createStream($content));
    }

    /**
     * Inject hidden field.
     *
     * @param string $body The body
     * @param string $tokenValue The token
     *
     * @return string The html content
     */
    private function injectFormHiddenFieldToResponse(string $body, string $tokenValue): string
    {
        $regex = '/(<form\b[^>]*>)(.*?)(<\/form>)/is';
        $htmlHiddenField = sprintf('$1<input type="hidden" name="%s" value="%s">$2$3', $this->name, $tokenValue);
        $body = preg_replace($regex, $htmlHiddenField, $body);

        return (string)$body;
    }

    /**
     * Inject jquery code.
     *
     * @param string $body The body data
     * @param string $tokenValue The token value
     *
     * @return string The html content
     */
    private function injectJqueryToResponse(string $body, string $tokenValue): string
    {
        $regex = '/(.*?)(<\/body>)/is';
        $jQueryCode = sprintf(
            '<script>$.ajaxSetup({beforeSend: function (xhr) ' .
            '{ xhr.setRequestHeader("X-CSRF-Token","%s"); }});</script>',
            $tokenValue
        );
        $body = preg_replace($regex, '$1' . $jQueryCode . '$2', $body, -1, $count) ?? '';

        if (!$count) {
            // Inject JS code anyway
            $body .= $jQueryCode;
        }

        return $body;
    }
}
