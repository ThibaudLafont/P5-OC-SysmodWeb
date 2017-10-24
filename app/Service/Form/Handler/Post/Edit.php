<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 08/10/17
 * Time: 23:06
 */

namespace App\Service\Form\Handler\Post;


class Edit extends Post
{
    private $id;

    public function __construct(\App\Model\Table\Admin $admin, \App\Model\Table\Show $show, $id){
        parent::__construct($admin);
        $this->setTable('show', $show);
        $this->id = $id;
    }

    public function GETEntity()
    {
        $id = $this->id;

        $entity = $this->getTable('show')->find($id);

        if(!$entity) header('Location: /404/');
        else return $entity;
    }

    public function execute($entity)
    {
        $this->getTable('admin')->edit($entity);

        $url = $entity->getUrl();
        header('Location: ' . $url);
    }
}