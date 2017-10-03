<?php
namespace App\Service\Form\Handler;


class Post extends \Core\Service\Form\Handler
{
    public function setEntity()
    {
        $entity_params = $this->entityParams(['title', 'author', 'sum', 'content']);
        $entity = new \App\Model\Entity\Post($entity_params);
        $this->entity = $entity;
    }

    public function setForm()
    {
        $entity = $this->getEntity();
        $formBuilder = new \App\Service\Form\Builder\Post($entity);
        $formBuilder->build();
        $form = $formBuilder->getForm();

        $this->form = $form;
    }
}