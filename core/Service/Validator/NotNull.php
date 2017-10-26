<?php
namespace Core\Service\Validator;

/**
 * Class NotNull
 * @package Core\Service\Validator
 *
 * Vérifie si la variable renseignée est nulle ou vide
 */
class NotNull extends Validator{

    /**
     * @param  mixed $var
     * @return bool
     */
	public function isValid($var){
	    if(is_string($var)) return $var != '';
	    else return is_null($var);
	}
	
}
