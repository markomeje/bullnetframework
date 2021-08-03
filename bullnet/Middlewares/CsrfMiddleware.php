<?php

declare(strict_types=1);

namespace Bullnet\Middlewares;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Csrf\Guard as Guard;

class CsrfMiddleware extends Guard implements Middleware
{

    // public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {
    //     return $this->process($request, $handler);
    // }

    /**
     * Process middleware
     *
     * @param  ServerRequestInterface  $request  request object
     * @param  RequestHandlerInterface $handler handler object
     *
     * @return ResponseInterface response object
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $this->validateStorage();
        if (in_array($request->getMethod(), ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            $body = $request->getParsedBody();
            $body = $body ? (array) $body : [];
            $name = isset($body[$this->prefix . '_name']) ? $body[$this->prefix . '_name'] : false;
            $value = isset($body[$this->prefix . '_value']) ? $body[$this->prefix . '_value'] : false;
            if (!$name || !$value || !$this->validateToken($name, $value)) {
                $request = $this->generateNewToken($request);
                $failureCallable = $this->getFailureCallable();
                return $failureCallable($request, $handler);
            }
        }
        // Generate new CSRF token if persistentTokenMode is false, or if a valid keyPair has not yet been stored
        if (!$this->persistentTokenMode || !$this->loadLastKeyPair()) {
            $request = $this->generateNewToken($request);
        } elseif ($this->persistentTokenMode) {
            $pair = $this->loadLastKeyPair() ? $this->keyPair : $this->generateToken();
            $request = $this->attachRequestAttributes($request, $pair);
        }
        // Enforce the storage limit
        $this->enforceStorageLimit();
        return $handler->handle($request);
    }

    /**
     * Getter for failureCallable
     *
     * @return callable|\Closure
     */
    public function getFailureCallable()
    {
        if (is_null($this->failureCallable)) {
            $this->failureCallable = function (Request $request, RequestHandler $handler): Response {
                $response = $handler->handle($request);
                $stream = $response->getBody();
                $stream->write('CSRF fail');
                return $response->withStatus(400);
            };
        }
        return $this->failureCallable;
    }
}