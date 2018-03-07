<?php

use Zend\ServiceManager\ServiceManager;

$params = require 'config/params.php';
$config = require 'config/dependencies.php';

$container = new ServiceManager($config);
$container->setService('config', $params);

return $container;