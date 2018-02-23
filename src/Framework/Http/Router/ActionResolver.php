<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/22/18
 * Time: 8:56 AM
 */

namespace Framework\Http\Router;


class ActionResolver
{
    public function resolve($handler) : callable
    {
        return is_string($handler) ? new $handler : $handler;
    }
}