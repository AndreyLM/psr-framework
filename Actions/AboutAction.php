<?php
namespace Actions;

use Framework\Template\Php\BaseAction;
use Zend\Diactoros\Response\JsonResponse;

class AboutAction extends BaseAction
{
    public function __invoke()
    {
        return new JsonResponse('I am a simple site');
    }
}