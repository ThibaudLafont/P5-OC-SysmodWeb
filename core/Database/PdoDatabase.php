<?php
namespace Core\Database;

class PdoDatabase{

	private $_pdo;

	public function __construct($dbHost, $dbName, $dbUser, $dbPass){
		$pdo = new \PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8", $dbUser, $dbPass);
		$this->_pdo = $pdo;
	}

	public function query($statement){

		$req = $this->_pdo->query($statement);

		$results = $req->fetchAll();

		return $results;

	}

}

