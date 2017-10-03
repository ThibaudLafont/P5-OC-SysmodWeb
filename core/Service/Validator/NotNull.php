<?php
namespace Core\Service\Validator;

class NotNull extends Validator{

	public function isValid($var){
		return $var != '';		
	}
	
}