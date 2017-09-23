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

	public function find($id){
		return $this->db->prepare("SELECT * FROM post WHERE id=?", [$id], '\App\Entity\PostEntity', true);
	}

}