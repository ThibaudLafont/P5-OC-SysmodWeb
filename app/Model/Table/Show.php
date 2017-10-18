<?php

namespace App\Model\Table;

class Show extends \Core\Model\Table\Table{

	public function all(){
		return $this->db->query("
            SELECT 
                id,
                author,
                title,
                sum,
                content,
                date,
                editDate,
                CASE 
                  WHEN editDate=null 
                  THEN date else editDate
                END as triDate                 
            FROM post 
            ORDER BY editDate DESC
            ", '\App\Model\Entity\Post');
	}

	public function find($post_slug){

		$titre = ucfirst($post_slug);
		$titre = str_replace('-', ' ', $titre);

        return $this->db->prepare("SELECT * FROM post WHERE title=?", [$titre], '\App\Model\Entity\Post', true);
	}

}