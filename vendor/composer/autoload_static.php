<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4c560eed4b8dbfdcfd40dc85ba92baba
{
    public static $files = array (
        'aaf5b53a99b4de51dadc23016def253f' => __DIR__ . '/..' . '/webimpress/http-middleware-compatibility/autoload/http-middleware.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zend\\Stratigility\\' => 18,
            'Zend\\Escaper\\' => 13,
            'Zend\\Diactoros\\' => 15,
        ),
        'W' => 
        array (
            'Webimpress\\ComposerExtraDependency\\' => 35,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
        ),
        'I' => 
        array (
            'Interop\\Http\\Server\\' => 20,
        ),
        'F' => 
        array (
            'Framework\\' => 10,
        ),
        'A' => 
        array (
            'Aura\\Router\\' => 12,
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zend\\Stratigility\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-stratigility/src',
        ),
        'Zend\\Escaper\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-escaper/src',
        ),
        'Zend\\Diactoros\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-diactoros/src',
        ),
        'Webimpress\\ComposerExtraDependency\\' => 
        array (
            0 => __DIR__ . '/..' . '/webimpress/composer-extra-dependency/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Interop\\Http\\Server\\' => 
        array (
            0 => __DIR__ . '/..' . '/http-interop/http-middleware/src',
        ),
        'Framework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Framework',
        ),
        'Aura\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/aura/router/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4c560eed4b8dbfdcfd40dc85ba92baba::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4c560eed4b8dbfdcfd40dc85ba92baba::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
