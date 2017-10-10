<?php
namespace App\Service\Form\Handler;


class Contact extends \Core\Service\Form\Handler
{
    public function POSTEntity()
    {
        $entity_params = $this->post2EntityParams(['name', 'email', 'content']);
        $entity = $this->buildEntity($entity_params);
        return $entity;
    }

    public function execute($entity)
    {
        vardump($entity);
    }
}