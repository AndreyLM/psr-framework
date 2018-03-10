<?php
namespace Framework\Template\Php;

use Framework\Template\ITemplateRenderer;
use League\Plates\Engine;

class PlateAdapter implements ITemplateRenderer
{
    /**
     * @var Engine
     */
    private $engine;

    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }

    public function render($name, array $params)
    {
        return $this->engine->render($name, $params);
    }
}