<?php
namespace Core\Service\Validator;

/**
 * Class Validator
 *
 * Le but est de pouvoir créer différents critères de validation sur un principe de fonctionnement commun
 * Cette classe a pour but d'intéragir avec \Core\Model\Form\Field et d'en valider les données
 */
abstract class Validator{

    /**
     * @var String $errorMessage Message d'erreur à afficher si la valeur est invalide
     */
	protected $errorMessage;

    /**
     * À la contruction on renseigne $this->errorMessage
     *
     * @param String $errorMessage
     */
	public function __construct(String $errorMessage){
		$this->setErrorMessage($errorMessage);
	} 

	////ABSTRACT

    /**
     * Fonction déterminant si la valeur est valide
     *
     * @param $var   Valeur à vérifier
     * @return bool  True si valid, false sinon
     */
	abstract public function isValid($var);


	////SETTERS

    /**
     * @param String $errorMessage
     */
	public function setErrorMessage(String $errorMessage){
		$this->errorMessage = $errorMessage;
	}


	////GETTERS

    /**
     * @return String
     */
	public function getErrorMessage(){
		return $this->errorMessage;
	}

}