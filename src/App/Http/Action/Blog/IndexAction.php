<?php
namespace App\Http\Action\Blog;


use Zend\Diactoros\Response\JsonResponse;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/20/18
 * Time: 11:38 AM
 */

class IndexAction
{
    public function __invoke()
    {
        return new  JsonResponse([
            [ 'id' => 2, 'title' => 'The first post'],
            ['id' => 1, 'title' => 'The second post'],
        ]);
    }
}