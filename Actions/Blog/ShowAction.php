<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/20/18
 * Time: 11:44 AM
 */

namespace Actions\Blog;


use Framework\Template\Php\BaseAction;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class ShowAction extends BaseAction
{
    public function __invoke(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('id');

         if($id > 5) {
            return new JsonResponse(['error' => 'Undefined page'], 404);
        }

        return new JsonResponse(['id'=>$id, 'title' => 'Post #'. $id]);
    }
}