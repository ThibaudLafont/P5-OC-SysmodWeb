<?php
namespace Core\Service\Validator;

/**
 * Class Email
 * @package Core\Service\Validator
 *
 * Valide si une chaine de caractères est au format email
 */
class Email extends Validator{

    /**
     * @param  String $var
     * @return bool
     */
	public function isValid($var){
		return filter_var($var, FILTER_VALIDATE_EMAIL);		
	}
	
}
