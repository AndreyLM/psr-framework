<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/14/18
 * Time: 10:54 AM
 */

namespace Framework\Template\Twig;


use Framework\Http\Router\IRouter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigRouteExtension extends AbstractExtension
{
    /**
     * @var IRouter
     */
    private $router;

    public function __construct(IRouter $router)
    {
        $this->router = $router;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('path', [$this, 'generatePath']),
        ];
    }

    public function generatePath($name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }
}