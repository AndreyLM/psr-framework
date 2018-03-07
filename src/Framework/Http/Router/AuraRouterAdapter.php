<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/21/18
 * Time: 9:37 AM
 */

namespace Framework\Http\Router;


use Aura\Router\Exception\RouteNotFound;
use Aura\Router\Route;
use Aura\Router\RouterContainer;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\RouteNotFoundException;
use Psr\Http\Message\ServerRequestInterface;

class AuraRouterAdapter implements IRouter
{
    /* @var $aura RouterContainer */
    private $aura;

    public function __construct(RouterContainer $aura)
    {
        $this->aura = $aura;
    }

    /**
     * @param ServerRequestInterface $request
     * @throws RequestNotMatchedException
     * @return Result
     */
    public function match(ServerRequestInterface $request): Result
    {
        $matcher = $this->aura->getMatcher();


        if($route = $matcher->match($request)) {
            return new Result($route->name, $route->handler, $route->attributes);
        }

        throw new RequestNotMatchedException($request);
    }

    /**
     * @param $name
     * @param array $params
     * @throws RouteNotFoundException
     * @return string
     */
    public function generate($name, array $params): string
    {
        $generator = $this->aura->getGenerator();
        try {
            return $generator->generate($name, $params);
        } catch (RouteNotFound $exception) {
            throw new RouteNotFoundException($name, $params, $exception);
        }
    }

    public function addRoute($name, $path, $handler, $methods, $options): void
    {
        $route = new Route();

        $route->name($name);
        $route->path($path);
        $route->handler($handler);

        foreach ($options as $name => $value) {
            switch ($name) {
                case 'tokens':
                    $route->tokens($value);
                    break;
                case 'defaults':
                    $route->defaults($value);
                    break;
                case 'wildcard':
                    $route->wildcard($value);
                    break;
                default:
                    throw new \InvalidArgumentException('Undefined option "' . $name . '"');
            }
        }

        if ($methods) {
            $route->allows($methods);
        }

        $this->aura->getMap()->addRoute($route);
    }
}