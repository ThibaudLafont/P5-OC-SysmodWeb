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

	public function find($id){
        return $this->db->prepare("SELECT * FROM post WHERE id=?", [$id], '\App\Model\Entity\Post', true);
	}

}