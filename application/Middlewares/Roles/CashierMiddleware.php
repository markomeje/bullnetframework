<?php

namespace Bullnet\Middlewares\Roles;
use Bullnet\Library\{Authenticated, Authentication};
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;



class CashierMiddleware implements MiddlewareInterface 
{

	public function process(RequestInterface $request, RequestHandler $handler): ResponseInterface 
	{
		if (Authenticated::user()->role !== 'cashier') {
			Authentication::unauthenticate();
			(new \Bullnet\Http\Response(200, ['Location:'. DOMAIN.'/login'], ''))->send();
		} 
        return $handler->handle($request);
    }

}