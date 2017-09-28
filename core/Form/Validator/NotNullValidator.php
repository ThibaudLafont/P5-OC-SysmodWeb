<?php
namespace Core\Form\Validator;

class NotNullValidator extends Validator{

	public function isValid($var){
		return $var != '';		
	}
	
}