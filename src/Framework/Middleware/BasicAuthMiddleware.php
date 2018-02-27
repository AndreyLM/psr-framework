<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/27/18
 * Time: 11:06 AM
 */

namespace Framework\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class BasicAuthMiddleware
{
    const ATTRIBUTE = '_user';
    private $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $username = $request->getServerParams()['PHP_AUTH_USER'];
        $password = $request->getServerParams()['PHP_AUTH_PW'];


        if(!empty($username) && !empty($password)) {
            foreach ($this->users as $user => $pass)
            {
                if($username === $user && $password === $pass) {
                    $request = $request->withAttribute(self::ATTRIBUTE, $username);
                    return $next($request, $response);
                }
            }
        }

        return $response->withStatus(401)->withHeader(
            'WWW-Authenticate', 'Basic realm=Restricted area');
    }
}