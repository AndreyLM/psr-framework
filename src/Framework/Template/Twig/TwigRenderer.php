<?php
namespace Framework\Template\Twig;

use Framework\Template\ITemplateRenderer;
use Twig\Environment;

class TwigRenderer implements ITemplateRenderer
{
    /**
     * @var Environment
     */
    private $environment;
    /**
     * @var
     */
    private $twig;

    public function __construct(Environment $twig, $extension)
    {
        $this->environment = $twig;
        $this->twig = $extension;
    }

    public function render($name, array $params)
    {
        return $this->environment->render($name.'.'.$this->twig, $params);
    }
}