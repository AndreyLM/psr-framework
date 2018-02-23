<?php


use Aura\Router\RouterContainer;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\SapiEmitter;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$aura = new RouterContainer();
$map = $aura->getMap();

$domainName = '/custom-framework/public';

$map->get('home', $domainName.'/', App\Http\Action\HelloAction::class);
$map->get('about', $domainName.'/about', App\Http\Action\AboutAction::class);
$map->get('blog', $domainName.'/blog', App\Http\Action\Blog\IndexAction::class);
$map->get('blog_show', $domainName.'/blog/{id}', App\Http\Action\Blog\ShowAction::class)->tokens(['id' => '\d+']);


$router = new AuraRouterAdapter($aura);

$request = ServerRequestFactory::fromGlobals();
$matcher = $aura->getMatcher();

try {
    $result = $matcher->match($request);
    foreach ($result->attributes as $attribute=>$value) {
        $request = $request->withAttribute($attribute, $value);
    }

    $action = is_string($result->handler) ? new $result->handler : $result->handler;
    $response = $action($request);

} catch (RequestNotMatchedException $e) {
    $response = new HtmlResponse('Undefined page 2', 404);
}

$response = $response->withHeader('X-Developer', 'AndrewLM');
$emitter = new SapiEmitter();
$emitter->emit($response);