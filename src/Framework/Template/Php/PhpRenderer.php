<?php
namespace Framework\Template\Php;

use Framework\Template\ITemplateRenderer;

class PhpRenderer implements ITemplateRenderer
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function render($name, array $params)
    {
        $templateFile = $this->path.'/'.$name.'php';

        require $templateFile;
    }
}