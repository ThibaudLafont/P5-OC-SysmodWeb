<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 08/10/17
 * Time: 23:06
 */

namespace App\Service\Form\Handler\Post;


class Add extends Post
{
    public function execute($entity)
    {
        $pdo = new \Core\Model\Db\PDO('labSQL', 'labBDD', 'root', 'pomme');

        $myDateTime = new \DateTime('now', new \DateTimeZone('Europe/Paris'));

        $table = new \App\Model\Table\Admin($pdo, $myDateTime, $entity);
        $table->add();
    }
}