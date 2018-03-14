<?php


$domainName = '/custom-framework/public';

/* @var $app Framework\Application */
$app->get('home', $domainName.'/', Actions\HelloAction::class);
$app->get('about', $domainName.'/about', Actions\AboutAction::class);
$app->get('blog', $domainName.'/blog', Actions\Blog\IndexAction::class);
$app->get('cabinet', $domainName.'/cabinet', Actions\CabinetAction::class);
$app->get('blog_show', $domainName.'/blog/{id}', Actions\Blog\ShowAction::class, ['tokens' => ['id' => '\d+']]);