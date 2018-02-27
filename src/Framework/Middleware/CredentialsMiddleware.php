<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/23/18
 * Time: 11:36 AM
 */

namespace Framework\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class CredentialsMiddleware
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $response = $next($request, $response);
        return $response->withHeader('X-Dev', 'Andrew');
    }

}