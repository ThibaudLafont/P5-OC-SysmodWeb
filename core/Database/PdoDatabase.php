<?php
namespace Core\Database;

class PdoDatabase{

	private $_pdo;

	public function __construct($dbHost, $dbName, $dbUser, $dbPass){
		$pdo = new \PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8", $dbUser, $dbPass);
		$this->_pdo = $pdo;
	}

	public function query($statement, $entity){

		$req = $this->_pdo->query($statement);

		$req->setFetchMode(\PDO::FETCH_CLASS, $entity);

		$results = $req->fetchAll();

		return $results;

	}

	public function prepare($statement, $params, $entity, $one){

		$req = $this->_pdo->prepare($statement);
		$req->execute($params);

		$req->setFetchMode(\PDO::FETCH_CLASS, $entity);

		if($one){
			return $req->fetch();
		}else{
			return $req->fetchAll();
		}

	}

}

