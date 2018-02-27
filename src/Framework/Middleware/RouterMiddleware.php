<?php
namespace Framework\Middleware;



use Framework\Http\Router\ActionResolver;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\IRouter;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;

class RouterMiddleware
{
    private $router;
    private $resolver;

    public function __construct(IRouter $router)
    {
        $this->router = $router;
        $this->resolver = new ActionResolver();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        try {
            $result = $this->router->match($request);
            foreach ($result->getAttributes() as $attribute=>$value) {
                $request = $request->withAttribute($attribute, $value);
            }

            $action = $this->resolver->resolve($result->getHandler());
            /* @var $response ResponseInterface */

            return $action($request);

        } catch (RequestNotMatchedException $e) {
            return new HtmlResponse('Undefined page 2', 404);
        }
    }
}