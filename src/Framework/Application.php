<?php
namespace  Framework;

use Framework\Http\Router\IRouter;
use Framework\Middleware\InteropHandlerWrapper;
use Framework\Middleware\UnknownMiddlewareTypeException;
use Interop\Http\Server\MiddlewareInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\MiddlewarePipe;


class Application extends MiddlewarePipe
{
    private $default;
    private $router;
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(IRouter $router, ResponseInterface $responsePrototype, callable $default, ContainerInterface $container)
    {
        parent::__construct();
        $this->setResponsePrototype($responsePrototype);
        $this->default = $default;
        $this->router = $router;
        $this->container = $container;
    }

    public function pipe($path, $middleware = null)
    {
        if($middleware === null) {
            return parent::pipe($this->resolve($path, $this->responsePrototype));
        }
        return parent::pipe($path, $this->resolve($middleware, $this->responsePrototype)); // TODO: Change the autogenerated stub
    }

    public function run(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this($request, $this->responsePrototype, $this->default);
    }

    public function any($name, $path, $handler, array $options = []): void
    {
        $this->router->addRoute($name, $path, $handler, [], $options);
    }

    public function get($name, $path, $handler, array $options = []): void
    {
        $this->router->addRoute($name, $path, $handler, ['GET'], $options);
    }

    public function post($name, $path, $handler, array $options = []): void
    {
        $this->router->addRoute($name, $path, $handler, ['POST'], $options);
    }

    public function put($name, $path, $handler, array $options = []): void
    {
        $this->router->addRoute($name, $path, $handler, ['PUT'], $options);
    }

    public function patch($name, $path, $handler, array $options = []): void
    {
        $this->router->addRoute($name, $path, $handler, ['PATCH'], $options);
    }

    public function delete($name, $path, $handler, array $options = []): void
    {
        $this->router->addRoute($name, $path, $handler, ['DELETE'], $options);
    }


    public function resolve($handler, ResponseInterface $responsePrototype): callable
    {
        if(is_string($handler) && $this->container->has($handler)) {
            return $this->resolve($this->container->get($handler), $responsePrototype);
        }

        if (\is_array($handler)) {
            return $this->createPipe($handler, $responsePrototype);
        }

        if (\is_string($handler)) {
            return function (ServerRequestInterface $request, ResponseInterface $response, callable $next) use ($handler) {
                $middleware = $this->resolve(new $handler(), $response);
                return $middleware($request, $response, $next);
            };
        }

        if ($handler instanceof MiddlewareInterface) {
            return function (ServerRequestInterface $request, ResponseInterface $response, callable $next) use ($handler) {
                return $handler->process($request, new InteropHandlerWrapper($next));
            };
        }

        if (\is_object($handler)) {
            $reflection = new \ReflectionObject($handler);
            if ($reflection->hasMethod('__invoke')) {
                $method = $reflection->getMethod('__invoke');
                $parameters = $method->getParameters();
                if (\count($parameters) === 2 && $parameters[1]->isCallable()) {
                    return function (ServerRequestInterface $request, ResponseInterface $response, callable $next) use ($handler) {
                        return $handler($request, $next);
                    };
                }
                return $handler;
            }
        }

        throw new UnknownMiddlewareTypeException($handler);
    }

    private function createPipe(array $handlers, $responsePrototype): MiddlewarePipe
    {
        $pipeline = new MiddlewarePipe();
        $pipeline->setResponsePrototype($responsePrototype);
        foreach ($handlers as $handler) {
            $pipeline->pipe($this->resolve($handler, $responsePrototype));
        }
        return $pipeline;
    }
}