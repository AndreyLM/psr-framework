<?php
namespace Actions;

use Framework\Template\Php\BaseAction;
use Psr\Http\Message\ServerRequestInterface;

class HelloAction extends BaseAction
{
    public function __invoke(ServerRequestInterface $request)
    {
        $name = isset($request->getQueryParams()['name']) ? $request->getQueryParams()['name'] : 'Guest';
        return $this->renderHtml('twig\hello', ['title' => 'hello']);
    }
}