<?php
namespace Core\Form\Builder;

use Core\Form\Form;

abstract class Builder{

	protected $form;

	public function __construct(\Core\Form\Entity\Entity $entity){

		$this->setForm(new Form($entity));

	}

	public abstract function build();

	private function setForm(Form $form){
		$this->form = $form;
	}
	public function getForm(){
		return $this->form;
	}

}