<?php
use App\Http\Action;

$domainName = '/custom-framework/public';

/* @var $app Framework\Application */
$app->get('home', $domainName.'/', Action\HelloAction::class);
$app->get('about', $domainName.'/about', Action\AboutAction::class);
$app->get('blog', $domainName.'/blog', Action\Blog\IndexAction::class);
$app->get('cabinet', $domainName.'/cabinet', Action\CabinetAction::class);
$app->get('blog_show', $domainName.'/blog/{id}', Action\Blog\ShowAction::class, ['tokens' => ['id' => '\d+']]);