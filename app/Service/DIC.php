<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 04/10/17
 * Time: 19:47
 */

namespace App\Service;


class DIC extends \Core\Service\DIC
{
    public static $app;

    public static function getInstance(){
        if(self::$app === null) self::$app = new DIC();
        return self::$app;
    }

    public function setController(){
        $this->set('Db', function(){
           return new \Core\Model\Db\PDO('labSQL', 'labBDD', 'root', 'pomme');
        });
        $this->set('Table', function(){
            $db = $this->get('Db');
            return new \App\Model\Table\Post($db);
        });
        $this->set('Controller', function(){
           $table = $this->get('Table');
           return new \App\Controller\Post($table);
        });
    }

}