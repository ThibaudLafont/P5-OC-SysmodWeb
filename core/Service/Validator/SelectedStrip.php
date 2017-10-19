<?php
namespace Core\Service\Validator;

class SelectedStrip extends Validator{

    private $strips_allowed;

    public function __construct($errorMessage, $strips_allowed){
        parent::__construct($errorMessage);
        $this->strips_allowed .= $strips_allowed;
    }

	public function isValid($var){
        return strlen($var) == strlen(strip_tags($var, $this->strips_allowed));
	}
	
}