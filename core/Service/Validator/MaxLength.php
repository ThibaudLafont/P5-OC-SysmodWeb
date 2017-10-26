<?php
namespace Core\Service\Validator;

/**
 * Class MaxLength
 * @package Core\Service\Validator
 *
 * Vérifie la longueur d'une chaine de caractères
 */
class MaxLength extends Validator{

    /**
     * @var int Longueur maximale authorisée
     */
	private	$maxLength;

    /**
     * Appel des setters
     *
     * @param String $errorMessage
     * @param Int    $maxLength
     */
	public function __construct(String $errorMessage, Int $maxLength){
		parent::__construct($errorMessage);
		$this->setMaxLength($maxLength);
	}


	////METHODS

    /**
     * Vérifie la longueur de la chaine
     *
     * @param  String $var
     * @return bool
     */
	public function isValid($var){
		$varLength = strlen($var);
		$maxLength = $this->getMaxLength();

		if($varLength > $maxLength) return false;
		return true;		
	}


	////SETTERS

    /**
     * @param $maxLength
     */
	public function setMaxLength(Int $maxLength){
		$this->maxLength = $maxLength;
	}


	////GETTERS

    /**
     * @return int
     */
	public function getMaxLength(){
		return $this->maxLength;
	}

}