<?php
namespace Core\Form\Validator;

abstract class Validator{

	protected $errorMessage;

	public function __construct($errorMessage){
		$this->setErrorMessage($errorMessage);
	} 

	abstract public function isValid($var);

	public function setErrorMessage($errorMessage){
		$this->errorMessage = $errorMessage;
	}

	public function getErrorMessage(){
		return $this->errorMessage;
	}
}