<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 09/10/17
 * Time: 22:13
 */

namespace App\Model\Table;


class Admin extends \Core\Model\Table\Table
{

    private $dateTime;
    private $entity;

    public function __construct($pdo, $dateTime, $entity){
        parent::__construct($pdo);
        $this->dateTime = $dateTime;
        $this->entity = $entity;
    }

    public function add(){

        $entity = $this->entity;
        $date = $this->dateTime->format('Y-m-d H:i');

        $values = [
            'title' => $entity->getTitle(),
            'author' => $entity->getAuthor(),
            'sum' => $entity->getSum(),
            'content' => $entity->getContent(),
            'date' => $date
        ];

        $this->insert('post', $values);

        $url = $entity->getUrl();
        header('Location: ' . $url);
    }

    public function edit($entity){

        $date = $this->dateTime->format('Y-m-d H:i');

        $id = $entity->getId();
        $values = [
            'title' => $entity->getTitle(),
            'author' => $entity->getAuthor(),
            'sum' => $entity->getSum(),
            'content' => $entity->getContent(),
            'editDate' => $date
        ];

        $this->update('post', $id, $values);

        $url = $entity->getUrl();
        header('Location: ' . $url);
    }

}