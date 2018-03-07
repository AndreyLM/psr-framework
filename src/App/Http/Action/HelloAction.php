<?php
namespace App\Http\Action;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class HelloAction
{

    /**
     * @var Engine
     */
    private $template;

    public function  __construct(Engine $template)
    {
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $name = isset($request->getQueryParams()['name']) ? $request->getQueryParams()['name'] : 'Guest';

        return new HtmlResponse('Hello, '. $name.'!');
    }
}