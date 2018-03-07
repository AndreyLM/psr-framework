<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/6/18
 * Time: 9:27 AM
 */
namespace Framework\Template;

interface ITemplateRenderer
{
    public function render($name, array $params);
}