<?php
namespace Core\Model\Form;

use Core\Model\Entity\Entity;
use Core\Model\Form\Field\Field;

class Form{

	private $entity,
			$fields = [];

	private $surround = 'p';

	private function surround($html){
		$tag = $this->surround;
		$html = "<{$tag}>{$html}</{$tag}>";
		return $html;
	}

	public function __construct(Entity $entity){
		$this->setEntity($entity);
	} 

	public function addField(Field $field){
		$getter = 'get' . ucfirst($field->getName());
		$field->setValue($this->getEntity()->$getter());
		$this->fields[] = $field;
		return $this;
	}

	public function isValid(){
		$valid = true;
		foreach($this->fields as $field){
			if(!$field->isValid()) $valid = false;
		}
		return $valid;
	}

	public function buildView(){
		$html = '';

		foreach($this->fields as $field){
			$html .= $this->surround($field->buildModule());
		}	

		return $html;
	}

	public function setEntity(Entity $entity){
		$this->entity = $entity;
	}

	public function getEntity(){
		return $this->entity;
	}
}