<?php

use Framework\Application;

use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;


chdir(dirname(__DIR__));

require 'vendor/autoload.php';


/* @var $container Zend\ServiceManager\ServiceManager */
$container = require 'config/container.php';
$app = $container->get(Application::class);

require 'config/routes.php';
require 'config/pipes.php';

$request = ServerRequestFactory::fromGlobals();
$response = $app->run($request, new Response());

$emitter = new SapiEmitter();
$emitter->emit($response);

