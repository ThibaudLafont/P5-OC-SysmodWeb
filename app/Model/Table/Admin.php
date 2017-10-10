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

    private $now;

    public function __construct(\Core\Model\Db\PDO $pdo, \DateTime $dateTime){
        parent::__construct($pdo);
        $this->now = $dateTime->format('Y-m-d H:i');
    }

    public function statementParams($entity){

        return [
            'title' => $entity->getTitle(),
            'author' => $entity->getAuthor(),
            'sum' => $entity->getSum(),
            'content' => $entity->getContent(),
            is_null($entity->getId()) ? 'date' : 'editDate' => $this->now
        ];

    }

    public function add($entity){

        $values = $this->statementParams($entity);
        $this->insert('post', $values);

    }

    public function edit($entity){

        $id = $entity->getId();
        $values = $this->statementParams($entity);
        $this->update('post', $id, $values);

    }


}