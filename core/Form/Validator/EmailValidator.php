<?php
namespace Core\Form\Validator;

class EmailValidator extends Validator{

	public function isValid($var){
		return filter_var($var, FILTER_VALIDATE_EMAIL);		
	}
	
}