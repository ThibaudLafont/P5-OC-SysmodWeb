<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 01/10/17
 * Time: 18:44
 */

namespace Core\Model\Table;

use \Core\Model\Db\PDO;

abstract class Db
{

    protected $db;

    public function __construct(PDO $db){
        $this->setDb($db);
    }

    private function setDb(PDO $db){
        $this->db = $db;
    }

}