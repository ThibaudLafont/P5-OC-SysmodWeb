<?php

namespace App\Model\Table;

class Show extends \Core\Model\Table\Table{

	public function all(){
		return $this->db->query("SELECT * FROM post", '\App\Model\Entity\Post');
	}

	public function find($post_slug){

		$titre = ucfirst($post_slug);
		$titre = str_replace('-', ' ', $titre);

        return $this->db->prepare("SELECT * FROM post WHERE title=?", [$titre], '\App\Model\Entity\Post', true);
	}

}