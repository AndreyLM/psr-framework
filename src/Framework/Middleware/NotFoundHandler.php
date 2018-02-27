<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/27/18
 * Time: 8:30 AM
 */

namespace Framework\Middleware;


use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class NotFoundHandler
{
    public function __invoke(ServerRequestInterface $request)
    {
        return new HtmlResponse('Undefined page', 404);
    }
}