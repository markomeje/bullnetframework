<?php

declare(strict_types=1);
namespace Bullnet\Middlewares;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Bullnet\Library\Authenticated;


class GuardMiddleware implements MiddlewareInterface
{


    public function process(RequestInterface $request, RequestHandler $handler): ResponseInterface 
    {
        if(empty(Authenticated::user()->id) || Authenticated::user()->status === false || Authenticated::user()->token !== Cookie::get()) {
            (new \Bullnet\Http\Response(200, ['Location:'. DOMAIN.'/login'], $response))->send();
        }

        return $handler->handle($request);
    }

}