<?php
namespace App\Service\Form\Handler\Post;

//Uses
use Core\Model\Table\Table;
use App\Model\Table\Admin;

abstract class Post extends \Core\Service\Form\Handler
{
    /**
     * @var Array Contient des instances de Core\Model\Table\Table
     */
    protected $table;

    /**
     * Post constructor.
     * @param Admin $table
     */
    public function __construct(Admin $table){
        $this->setTable('admin', $table);
    }


    ////METHODS

    /**
     * @return \Core\Model\Entity\Entity
     */
    public function POSTEntity()
    {
        $POST_values = $this->post2EntityParams(['id', 'title', 'author', 'sum', 'content']);

        $entity = $this->buildEntity($POST_values);
        return $entity;
    }


    ////SETTERS

    /**
     * @param String $key
     * @param Table  $table
     */
    public function setTable($key, Table $table){
        $this->table[$key] = $table;
    }


    ////GETTERS

    /**
     * @param  string $key
     * @return Table
     */
    public function getTable($key = 'admin'){
        return $this->table[$key];
    }

}
