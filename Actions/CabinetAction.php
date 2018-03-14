<?php
namespace Actions;


use Framework\Middleware\BasicAuthMiddleware;
use Framework\Template\Php\BaseAction;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;


class CabinetAction extends BaseAction
{

    public function __invoke(ServerRequestInterface $request)
    {
        $username = $request->getAttribute(BasicAuthMiddleware::ATTRIBUTE);

        return new HtmlResponse('I am logged in as ' . $username);
    }

}