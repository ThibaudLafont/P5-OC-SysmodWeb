<?php
namespace App\Model\Entity;

/**
 * Class Contact
 * @package App\Model\Entity
 */
class Contact extends \Core\Model\Entity\Entity
{

    /**
     * @var String $name Nom de l'expéditeur
     * @var Email  $email Mail de l'expéditeur
     * @var String $content Contenu du mail
     */
	private $name,
			$email,
			$content;


	////SETTERS

    /**
     * @param String $name
     */
	public function setName(String $name){
		$this->name = $name;
	}

    /**
     * @param String $mail
     */
	public function setEmail(String $mail){
		$this->email = $mail;
	}

    /**
     * @param String $content
     */
	public function setContent(String $content){
		$this->content = $content;
	}


	////GETTERS

    /**
     * @return String
     */

	public function getName(){
		return $this->name;
	}

    /**
     * @return String
     */
	public function getEmail(){
		return $this->email;
	}

    /**
     * @return String
     */
	public function getContent(){
		return $this->content;
	}
	
}
