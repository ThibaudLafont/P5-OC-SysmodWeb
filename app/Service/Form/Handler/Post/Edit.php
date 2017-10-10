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

    public function __construct($slug){
        $this->slug = $slug;
    }

    public function getEntity()
    {
        $pdo = new \Core\Model\Db\PDO('labSQL', 'labBDD', 'root', 'pomme');

        $table = new \App\Model\Table\Show($pdo);
        $slug = $this->slug;

        return $table->find($slug);
    }

    public function execute($entity)
    {
        $pdo = new \Core\Model\Db\PDO('labSQL', 'labBDD', 'root', 'pomme');

        $myDateTime = new \DateTime('now', new \DateTimeZone('Europe/Paris'));

        $table = new \App\Model\Table\Admin($pdo, $myDateTime, $entity);

        $table->edit($entity);
    }
}