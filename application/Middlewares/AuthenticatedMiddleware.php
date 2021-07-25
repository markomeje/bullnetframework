<?php

namespace Bullnet\Middlewares;
use Bullnet\Library\{Authenticated, Authentication};
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;
use Bullnet\Http\Response;

class AuthenticatedMiddleware implements MiddlewareInterface {

	public function process(RequestInterface $request, RequestHandler $handler): ResponseInterface {
		if (Authenticated::user()->status === false || Authenticated::user()->id === 0){
			Authentication::unauthenticate();
			(new Response(200, ['Location:'. DOMAIN.'/login'], ''))->send();
		} 
			
        return $handler->handle($request);
    }

}