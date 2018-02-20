<?php

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\SapiEmitter;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$request = ServerRequestFactory::fromGlobals();


$name = $request->getQueryParams()['name'] ? $request->getQueryParams()['name'] : "Guest";

$response = (new HtmlResponse('Hello, '. $name. '!'))->withHeader('X-Developer', 'AndrewLM');

$emitter = new SapiEmitter();

$emitter->emit($response);