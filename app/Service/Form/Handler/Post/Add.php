<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 08/10/17
 * Time: 23:06
 */

namespace App\Service\Form\Handler\Post;


class Add extends Post
{
    public function execute($entity)
    {
        $this->getTable()->add($entity);

        $url = $entity->getUrl();
        header('Location: ' . $url);
    }
}