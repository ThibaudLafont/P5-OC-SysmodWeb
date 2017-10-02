<?php

namespace App\Model\Table;

class Post extends \Core\Model\Table\Db{

	public function all(){
		return $this->db->query("SELECT * FROM post", '\App\Model\Entity\Post');
	}

	public function find($param){

		$titre = ucfirst($param);
		$titre = str_replace('-', ' ', $titre);

		return $this->db->prepare("SELECT * FROM post WHERE title=?", [$titre], '\App\Model\Entity\Post', true);
	}

}