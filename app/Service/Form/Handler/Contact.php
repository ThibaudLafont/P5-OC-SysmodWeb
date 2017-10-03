<?php
namespace App\Service\Form\Handler;


class Contact extends \Core\Service\Form\Handler
{
    public function setEntity()
    {
        $entity_params = $this->entityParams(['name', 'email', 'content']);
        $entity = new \App\Model\Entity\Contact($entity_params);
        $this->entity = $entity;
    }

    public function setForm()
    {
        $entity = $this->getEntity();
        $formBuilder = new \App\Service\Form\Builder\Contact($entity);
        $formBuilder->build();
        $form = $formBuilder->getForm();

        $this->form = $form;
    }
}