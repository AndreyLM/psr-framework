<?php

namespace Framework\Middleware;

class UnknownMiddlewareTypeException extends \InvalidArgumentException
{
    private $type;

    public function __construct($type)
    {
        parent::__construct('Unknown middleware type');
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
}
