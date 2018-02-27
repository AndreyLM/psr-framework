<?php
namespace  Framework;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\MiddlewarePipe;


class Application extends MiddlewarePipe
{
    private $default;

    public function __construct(ResponseInterface $responsePrototype, callable $default)
    {
        parent::__construct();
        $this->setResponsePrototype($responsePrototype);
        $this->default = $default;
    }

    public function run(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this($request, $response, $this->default);
    }
}