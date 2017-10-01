<?php
namespace Core\Form\Entity;

class ContactEntity extends Entity{

	private $name,
			$mail,
			$content;

	public function setName($name){
		$this->name = $name;
	}
	public function setMail($mail){
		$this->mail = $mail;
	}
	public function setContent($content){
		$this->content = $content;
	}

	public function getName(){
		return $this->name;
	}
	public function getMail(){
		return $this->mail;
	}
	public function getContent(){
		return $this->content;
	}
	
}