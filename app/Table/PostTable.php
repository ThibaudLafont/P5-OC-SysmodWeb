<?php

namespace App\Table;

class PostTable{

	protected $db;

	public function __construct(\Core\Database\PdoDatabase $db){
		$this->setDb($db);
	}

	private function setDb($db){
		$this->db = $db;
	}

	public function all(){
		return $this->db->query("SELECT * FROM post", '\App\Entity\PostEntity');
	}

	public function find($param){

		$titre = ucfirst($param);
		$titre = str_replace('-', ' ', $titre);

		return $this->db->prepare("SELECT * FROM post WHERE titre=?", [$titre], '\App\Entity\PostEntity', true);
	}

}