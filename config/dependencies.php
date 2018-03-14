<?php

use Aura\Router\RouterContainer;
use Framework\Application;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\IRouter;
use Framework\Middleware\BasicAuthMiddleware;
use Framework\Middleware\ErrorHandler;
use Framework\Middleware\NotFoundHandler;
use Framework\Template\ITemplateRenderer;
use Framework\Template\Php\PlateAdapter;
use Framework\Template\Twig\TwigRenderer;
use Framework\Template\Twig\TwigRouteExtension;
use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\Response;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

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
        ITemplateRenderer::class => function(ContainerInterface $container) {
            if($container->get('config')['template'] === 'plate')
                return $container->get(League\Plates\Engine::class);
            if($container->get('config')['template'] === 'twig')
                return $container->get(TwigRenderer::class);
            throw new ServiceNotFoundException('Cannot find appropriate template engine');
        },
        TwigRenderer::class => function(ContainerInterface $container) {
            $debug = $container->get('config')['debug'];
            $config = $container->get('config')['twig'];

            $loader = new Twig\Loader\FilesystemLoader();
            $loader->addPath($config['dir']);

            $environment = new Twig\Environment($loader, [
//                'cache' => $debug ? false : $config['cache_dir'],
                'cache' => false,
                'debug' => $debug,
                'strict_variables' => $debug,
                'auto_reload' => $debug,
            ]);

            if ($debug) {
                $environment->addExtension(new Twig\Extension\DebugExtension());
            }

//            $environment->addExtension($container->get(TwigRouteExtension::class));

            foreach ($config['extensions'] as $extension) {
                $environment->addExtension($container->get($extension));
            }

            return new TwigRenderer($environment,
                $container->get('config')['twig']['extension']);

        },
        League\Plates\Engine::class => function(ContainerInterface $container) {
            $template =  new Engine();

            if($container->get('config')['plateRenderer']['dir'])
                $template->setDirectory($container->get('config')['plateRenderer']['dir']);
            if($container->get('config')['plateRenderer']['views'])
                $template->addFolder('views', $container->get('config')['plateRenderer']['views']);
            if($container->get('config')['plateRenderer']['layouts'])
                $template->addFolder('layouts', $container->get('config')['plateRenderer']['layouts']);
            if($container->get('config')['plateRenderer']['partials'])
                $template->addFolder('partials', $container->get('config')['plateRenderer']['partials']);

            return new PlateAdapter($template);
        }
    ],
];