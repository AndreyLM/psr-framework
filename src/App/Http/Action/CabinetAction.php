<?php
namespace App\Http\Action;


use Framework\Middleware\BasicAuthMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class CabinetAction
{

    public function __invoke(ServerRequestInterface $request)
    {
        $username = $request->getAttribute(BasicAuthMiddleware::ATTRIBUTE);

        return new HtmlResponse('I am logged in as ' . $username);
    }

}