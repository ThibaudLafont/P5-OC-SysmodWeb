<?php
namespace App\Service\Form\Handler\Post;

//Uses
use App\Model\Entity\Post;

/**
 * Class Add
 * @package App\Service\Form\Handler\Post
 */
class Add extends \App\Service\Form\Handler\Post\Post
{

    /**
     * @param Post $entity
     */
    public function execute($entity)
    {
        $this->getTable()->add($entity);

        $url = $entity->getUrl();
        header('Location: ' . $url);
    }
}
