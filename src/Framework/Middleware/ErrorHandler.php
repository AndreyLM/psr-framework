<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/27/18
 * Time: 11:22 AM
 */

namespace Framework\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class ErrorHandler
{
    private $debug;

    public function __construct($debug)
    {
        $this->debug = $debug;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {

        try {
            return $next($request, $response);
        } catch (\Throwable $exception) {
            if(!$this->debug) {
                return new HtmlResponse('Server error', 500);
            }
            return new JsonResponse([
               'error' => 'Server error',
               'code' => $exception->getCode(),
               'message' => $exception->getMessage(),
               'trace' => $exception->getTrace()
            ], 500);
        }

    }
}