<?php
namespace App\Model\Entity;

class Contact extends \Core\Model\Entity\Entity{

	private $name,
			$email,
			$content;

	public function setName($name){
		$this->name = $name;
	}
	public function setEmail($mail){
		$this->email = $mail;
	}
	public function setContent($content){
		$this->content = $content;
	}

	public function getName(){
		return $this->name;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getContent(){
		return $this->content;
	}
	
}