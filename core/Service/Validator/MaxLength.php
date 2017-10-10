<?php
namespace Core\Service\Validator;

class MaxLength extends Validator{

	private	$maxLength;

	public function __construct($errorMessage, $maxLength){
		parent::__construct($errorMessage);
		$this->setMaxLength($maxLength);
	}

	public function isValid($var){
		$varLength = strlen($var);
		$maxLength = $this->getMaxLength();

		if($varLength > $maxLength) return false;
		return true;		
	}

	public function setMaxLength($maxLength){
		$this->maxLength = $maxLength;
	}

	public function getMaxLength(){
		return $this->maxLength;
	}
}