<?php
require_once (dirname(__FILE__).'/../Test/Test1.php');
use Test\Test1;
//use Framework\Application;
//
//use Zend\Diactoros\Response;
//use Zend\Diactoros\Response\SapiEmitter;
//use Zend\Diactoros\ServerRequestFactory;
//
//
//chdir(dirname(__DIR__));
//
//require 'vendor/autoload.php';


/* @var $container Zend\ServiceManager\ServiceManager */

$action = new Test1();
echo var_dump($action);

