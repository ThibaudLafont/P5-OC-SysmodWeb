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
    private $slug;

    public function __construct(\App\Model\Table\Admin $admin, \App\Model\Table\Show $show, $slug){
        parent::__construct($admin);
        $this->setTable('show', $show);
        $this->slug = $slug;
    }

    public function GETEntity()
    {
        $slug = $this->slug;

        return $this->getTable('show')->find($slug);
    }

    public function execute($entity)
    {
        $this->getTable('admin')->edit($entity);

        $url = $entity->getUrl();
        header('Location: ' . $url);
    }
}