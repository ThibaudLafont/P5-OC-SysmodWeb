<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 01/10/17
 * Time: 18:44
 */

namespace Core\Model\Table;

use \Core\Model\Db\PDO;

abstract class Table
{

    protected $db;

    public function __construct(PDO $db){
        $this->setDb($db);
    }

    private function setDb(PDO $db){
        $this->db = $db;
    }

    public function update($table, $id, $data){
        $sqlSet = [];
        $attributes = [];

        foreach($data as $key => $value){
            $sqlSet[] = $key . '=?';
            $attributes[] = $value;
        }

        $sqlSet = implode(', ', $sqlSet);
        $attributes[] = $id;

        $this->db->prepare("UPDATE {$table} SET $sqlSet WHERE id=?", $attributes, null);
    }

    public function insert($table, $data){
        $sqlFields = [];
        $sqlSet = [];

        foreach($data as $key => $value){
            $sqlFields[] = $key;
            $sqlSet[] = ':' . $key;
        }

        $sqlFields = implode(', ', $sqlFields);
        $sqlSet = implode(', ', $sqlSet);
        $statement = "INSERT INTO {$table}({$sqlFields}) VALUES ({$sqlSet})";
        $this->db->prepare($statement, $data);
    }

}