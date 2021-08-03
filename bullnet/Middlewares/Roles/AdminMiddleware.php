<?php

declare(strict_types=1);
namespace Bullnet\Middlewares\Roles;
use Bullnet\Library\{Authenticated, Authentication};
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;

/**
 * Admin middleware
 * For admins only
 */
class AdminMiddleware implements MiddlewareInterface 
{

	public function process(RequestInterface $request, RequestHandler $handler) : ResponseInterface 
	{
		if (Authenticated::user()->role !== 'admin') {
			Authentication::unauthenticate();
			(new \Bullnet\Http\Response(200, ['Location:'. DOMAIN.'/login'], ''))->send();
		} 
        return $handler->handle($request);
    }

}