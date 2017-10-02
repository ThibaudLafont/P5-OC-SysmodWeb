<?php
namespace Core\Service\Form\Builder;

use Core\Model\Form\Form;

abstract class Builder{

	protected $form;

	public function __construct(\Core\Model\Entity\Entity $entity){

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