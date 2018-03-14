<?php

use Framework\Template\Twig\TwigRouteExtension;

return $params = [
    'debug' => true,
    'users' => [
        'admin3' => 'password',
    ],
//    'template' => 'plate',
    'template' => 'twig',
    'plateRenderer' => [
        'dir' => 'Views',
        'views' => 'Views',
        'layouts' => 'Views/layouts',
        'partials' => 'Views/partials'
    ],
    'twig' => [
        'dir' => 'Views',
        'cache_dir' => 'var/cache/twig',
        'extension' => 'twig',
        'extensions' => [
            TwigRouteExtension::class,
        ]
    ]
];