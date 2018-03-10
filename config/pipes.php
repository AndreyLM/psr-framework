<?php

use Framework\Middleware\BasicAuthMiddleware;
use Framework\Middleware\CredentialsMiddleware;
use Framework\Middleware\ErrorHandler;
use Framework\Middleware\RouterMiddleware;
use Framework\Middleware\TimeProfilerMiddleware;

/* @var $params array */
/* @var $app Framework\Application */
/* @var $container Zend\ServiceManager\ServiceManager */
$domainName = '/psr-framework/public';

$app->pipe(ErrorHandler::class);
$app->pipe(TimeProfilerMiddleware::class);
$app->pipe(CredentialsMiddleware::class);
$app->pipe($domainName.'/cabinet', BasicAuthMiddleware::class);
$app->pipe(RouterMiddleware::class);