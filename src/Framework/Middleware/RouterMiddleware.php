<?php
namespace Framework\Middleware;



use Framework\Application;
use Framework\Http\Router\ActionResolver;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\IRouter;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;

class RouterMiddleware
{
    private $router;
    private $app;

    public function __construct(IRouter $router, Application $application)
    {
        $this->router = $router;
        $this->app = $application;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        try {
            $result = $this->router->match($request);
            foreach ($result->getAttributes() as $attribute=>$value) {
                $request = $request->withAttribute($attribute, $value);
            }

            $action = $this->app->resolve($result->getHandler(), $response);
            /* @var $response ResponseInterface */

            return $action($request, $response, $next);

        } catch (RequestNotMatchedException $e) {
            return new HtmlResponse('Undefined page 2', 404);
        }
    }
}