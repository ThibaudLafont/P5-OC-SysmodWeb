<?php
namespace Core\Model\Db;

class PDO{

	private $_pdo;

	public function __construct($dbHost, $dbName, $dbUser, $dbPass){
		$pdo = new \PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8", $dbUser, $dbPass);
		$this->_pdo = $pdo;
	}

	public function fetchForMe($request, $entity, $one){

        if($entity !== null) $request->setFetchMode(\PDO::FETCH_CLASS, $entity);

        if($one) $result = $request->fetch();
        else     $result = $request->fetchAll();

        return $result;
    }

	public function query($statement, $entity = null, $one = false){

		$req = $this->_pdo->query($statement);
        if(strpos($statement, 'INSERT')) return;

        $result = $this->fetchForMe($req, $entity, $one);
        return $result;
	}

	public function prepare($statement, $params, $entity = null, $one = false){
		$req = $this->_pdo->prepare($statement);
		$req->execute($params);

        if(strpos($statement, 'INSERT')) return;

        $result = $this->fetchForMe($req, $entity, $one);

        return $result;
	}

	public function lastInsertId(){
	    return $this->_pdo->lastInsertId();
    }

}

