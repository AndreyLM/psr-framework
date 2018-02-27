<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 9:59 AM
 */

namespace Framework\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TimeProfilerMiddleware
{


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $start = microtime(true);
        $response = $next($request, $response);
        return $response->withHeader('X-Time', microtime(true) - $start);
    }
}