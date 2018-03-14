<?php
namespace Actions\Blog;


use Framework\Template\Php\BaseAction;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/20/18
 * Time: 11:38 AM
 */

class IndexAction extends BaseAction
{
    public function __invoke()
    {
        return new  JsonResponse([
            [ 'id' => 2, 'title' => 'The first post'],
            ['id' => 1, 'title' => 'The second post'],
        ]);
    }
}