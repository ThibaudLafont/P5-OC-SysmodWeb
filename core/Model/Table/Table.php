<?php
namespace Core\Model\Table;

//Uses
use \Core\Model\Db\PDO;

/**
 * Class Table
 *
 * Base de toute classe agissant en intermédiaire \Core\Model\Db\PDO -> Controller
 *
 * Dependency : \Core\Model\Db\PDO
 */
abstract class Table
{

    /**
     * @var \Core\Model\Db\PDO
     */
    protected $db;

    /**
     * @param \Core\Model\Db\PDO $db
     */
    public function __construct(PDO $db){
        $this->setDb($db);
    }


    ////METHODS

    /**
     * Execute dynamiquement l'insertion d'une entrée dans une table choisie
     *
     * @param String $table Nom de la table
     * @param array  $data  Tableau à clé contenant les champs de la table et les valeurs à leur assigner
     */
    public function insert(String $table, Array $data){
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

    /**
     * Execute dynamiquement la mise à jour d'une entrée dans une table choisie
     *
     * @param String $table Nom de la table à mettre à jour
     * @param Int    $id    Id de l'entrée visée
     * @param array  $data  Tableau à clé contenant les champs de la table visés et les valeurs à leur assigner
     */
    public function update(String $table, Int $id, Array $data){
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


    ////SETTERS

    /**
     * @param \Core\Model\Db\PDO $db
     */
    private function setDb(PDO $db){
        $this->db = $db;
    }

}