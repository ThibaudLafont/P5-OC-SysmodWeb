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
    protected $table;

    public function __construct(\App\Model\Table\Admin $table){
        $this->setTable('admin', $table);
    }
    public function POSTEntity()
    {
        $POST_values = $this->post2EntityParams(['id', 'title', 'author', 'sum', 'content']);

        $entity = $this->buildEntity($POST_values);
        return $entity;
    }
    public function setTable($key, \Core\Model\Table\Table $table){
        $this->table[$key] = $table;
    }
    public function getTable($key = 'admin'){
        return $this->table[$key];
    }
}