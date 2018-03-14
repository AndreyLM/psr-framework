<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/13/18
 * Time: 10:20 AM
 */

namespace Framework\Template\Php;


use Framework\Template\ITemplateRenderer;
use League\Plates\Engine;
use Zend\Diactoros\Response\HtmlResponse;

class BaseAction
{
    /**
     * @var Engine
     */
    protected $template;

    public function  __construct(ITemplateRenderer $template)
    {
        $this->template = $template;
    }

    public function renderHtml($view, array $args)    {

        return new HtmlResponse($this->template->render($view, $args));
    }

}