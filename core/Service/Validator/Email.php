<?php
namespace Core\Service\Validator;

class Email extends Validator{

	public function isValid($var){
		return filter_var($var, FILTER_VALIDATE_EMAIL);		
	}
	
}