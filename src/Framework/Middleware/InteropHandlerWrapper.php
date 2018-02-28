<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/28/18
 * Time: 8:22 AM
 */

namespace Framework\Middleware;


use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class InteropHandlerWrapper implements RequestHandlerInterface
{
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function handle(ServerRequestInterface $request)
    {
        return ($this->callback)($request);
    }
}