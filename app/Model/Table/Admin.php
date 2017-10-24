<?php
namespace App\Model\Table;

//Uses
use App\Model\Entity\Post;
use Core\Model\Db\PDO;

/**
 * Class Admin
 * @package App\Model\Table
 *
 * Extension de Core\Model\Table servant à l'ajout et la modification des posts via \Core\Model\Db\PDO
 */
class Admin extends \Core\Model\Table\Table
{

    /**
     * @var string $now DateTime actuel
     */
    private $now,
            $dateTime;

    /**
     * Admin constructor
     * @param PDO $pdo
     * @param \DateTime $dateTime
     */
    public function __construct(PDO $pdo, \DateTime $dateTime){
        parent::__construct($pdo);
        $this->setDateTime($dateTime);
    }


    ////METHODS

    /**
     * @param Post $entity
     */
    public function add(Post $entity){

        //On insère le post en BDD
        $values = $this->statementParams($entity);
        $this->insert('post', $values);

        //On attribue l'ID à l'entity pour qu'elle puisse construire une URL
        $id = $this->db->lastInsertId();
        $entity->setId($id);
    }

    /*
     * @param Post $entity
     */
    public function edit(Post $entity){

        $id = $entity->getId();
        $values = $this->statementParams($entity);
        $this->update('post', $id, $values);

    }

    /**
     * @param $entity
     * @return array
     */
    public function statementParams(Post $entity){

        $this->setNow();

        return [
            'title' => $entity->getTitle(),
            'author' => $entity->getAuthor(),
            'sum' => $entity->getSum(),
            'content' => $entity->getContent(),
            is_null($entity->getId()) ? 'date' : 'editDate' => $this->getNow()
        ];

    }


    ////SETTERS

    /**
     * @param \DateTime $dateTime
     */
    public function setDateTime(\DateTime $dateTime){
        $this->dateTime = $dateTime;
    }

    /**
     * Assigne le datetime actuel
     */
    public function setNow(){
        $this->now = $this->getDateTime()->format('Y-m-d H:i');
    }


    ////GETTERS

    /**
     * @return \DateTime
     */
    public function getDateTime(){
        return $this->dateTime;
    }

    /**
     * @return string
     */
    public function getNow(){
        return $this->now;
    }

}