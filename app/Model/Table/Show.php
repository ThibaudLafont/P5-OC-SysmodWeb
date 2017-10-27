<?php
namespace App\Model\Table;

/**
 * Class Show
 * @package App\Model\Table
 *
 * Extension de Core\Model\Table servant à la récupération des posts via \Core\Model\Db\PDO
 */
class Show extends \Core\Model\Table\Table{

    /**
     * Récupère tous les posts
     *
     * @return Array Composé de \App\Model\Entity\Post
     */
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
                  WHEN editDate IS NULL
                  THEN date 
                  ELSE editDate
                END as triDate                 
            FROM post 
            ORDER BY triDate DESC
            ", '\App\Model\Entity\Post');
	}

    /**
     * @return Int
     */
    public function authorsNumber(){
        return $this->db->query("SELECT COUNT(DISTINCT author) FROM post", null, true);
    }

    /**
     * @param $id
     * @return \App\Model\Entity\Post
     */
	public function find($id){
        return $this->db->prepare("SELECT * FROM post WHERE id=?", [$id], '\App\Model\Entity\Post', true);
	}

    /**
     * @return \App\Model\Entity\Post
     */
	public function lastInsertDate(){
	    return $this->db->query("SELECT MAX(date) as date FROM post", '\App\Model\Entity\Post', true);
    }

}
