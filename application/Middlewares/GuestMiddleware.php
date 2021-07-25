<?php 

declare(strict_types=1);
namespace Bullnet\Middlewares;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Bullnet\Library\Authenticated;
use Psr\Http\Server\MiddlewareInterface;



class GuestMiddleware implements MiddlewareInterface 
{

    public function process(RequestInterface $request, RequestHandler $handler): ResponseInterface 
    {
        if(Authenticated::user()->id !== 0 || Authenticated::user()->status === true) {
        	(new \Bullnet\Http\Response(200, ['Location:'. DOMAIN], ''))->send();
        } 
        return $handler->handle($request);
    }

}