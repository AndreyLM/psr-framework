<?php

use Aura\Router\RouterContainer;
use Framework\Application;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\IRouter;
use Framework\Middleware\BasicAuthMiddleware;
use Framework\Middleware\ErrorHandler;
use Framework\Middleware\NotFoundHandler;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\Response;

return [
    'abstract_factories' => [
        Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class
    ],
    'factories' => [
        Application::class => function(ContainerInterface $container) {
            return new Application($container->get(IRouter::class), new Response(), new NotFoundHandler(), $container);
        },
        IRouter::class => function() {
            return new AuraRouterAdapter(new RouterContainer());
        },
        BasicAuthMiddleware::class => function(ContainerInterface $container) {
            return new BasicAuthMiddleware($container->get('config')['users']);
        },
        ErrorHandler::class => function(ContainerInterface $container) {
            return new ErrorHandler($container->get('config')['debug']);
        },
    ],
];