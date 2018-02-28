<?php


use Aura\Router\RouterContainer;
use Framework\Application;
use Framework\Http\Router\ActionResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Middleware\BasicAuthMiddleware;
use Framework\Middleware\ErrorHandler;
use Framework\Middleware\NotFoundHandler;
use Framework\Middleware\RouterMiddleware;
use Framework\Middleware\CredentialsMiddleware;
use Framework\Middleware\TimeProfilerMiddleware;

use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$params = [
    'debug' => false,
    'users' => [
        'admin3' => 'password',
    ]
];

$aura = new RouterContainer();
$map = $aura->getMap();

$domainName = '/custom-framework/public';

$map->get('home', $domainName.'/', App\Http\Action\HelloAction::class);
$map->get('about', $domainName.'/about', App\Http\Action\AboutAction::class);
$map->get('blog', $domainName.'/blog', App\Http\Action\Blog\IndexAction::class);
$map->get('cabinet', $domainName.'/cabinet', App\Http\Action\CabinetAction::class);
$map->get('blog_show', $domainName.'/blog/{id}', App\Http\Action\Blog\ShowAction::class)->tokens(['id' => '\d+']);

$resolver = new ActionResolver();
$router = new AuraRouterAdapter($aura);

$app = new Application(new Response(), new NotFoundHandler());

$app->pipe(new ErrorHandler($params['debug']));
$app->pipe(TimeProfilerMiddleware::class);
$app->pipe(CredentialsMiddleware::class);
$app->pipe(new BasicAuthMiddleware($params['users']));
$app->pipe(new RouterMiddleware($router));

$request = ServerRequestFactory::fromGlobals();

$response = $app->run($request, new Response());

$emitter = new SapiEmitter();
$emitter->emit($response);

