<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 09/10/17
 * Time: 15:03
 */

namespace App\Service\Form\Handler\Post;


abstract class Post extends \Core\Service\Form\Handler
{
    public function postEntity()
    {
        $POST_values = $this->post2EntityParams(['id', 'title', 'author', 'sum', 'content']);

        $entity = $this->buildEntity($POST_values);
        return $entity;
    }
}