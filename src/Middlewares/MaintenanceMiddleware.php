<?php

namespace App\Middlewares;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MaintenanceMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $req, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!empty($_ENV['APP_MAINTENANCE'])) {
            $response = new \Laminas\Diactoros\Response;
            $response->getBody()->write("Maintenance Application");
            return $response;
        }

        return $handler->handle($req);
    }
}
