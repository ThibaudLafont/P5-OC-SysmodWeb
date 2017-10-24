<?php
namespace Core\Service\Validator;

/**
 * Class SelectedStrip
 * @package Core\Service\Validator
 *
 * Vérifie qu'il n'y a pas de tags HTML ou PHP, ou qu'ils ont été autorisés
 */
class SelectedStrip extends Validator{

    /**
     * @var string $strips_allowed Les balises HTML tolérées durant la validation
     */
    private $strips_allowed;

    /**
     * On renseigne en plus de errorMessage les balises tolérées
     * !!! Utiliser '' si aucune balise n'est tolérée !!!
     *
     * @param String $errorMessage
     * @param String $strips_allowed (voir ex dans $this->setStripsAllowed())
     */
    public function __construct(String $errorMessage, String $strips_allowed){
        parent::__construct($errorMessage);
        $this->setStripsAllowed($strips_allowed);
    }


    ////METHODS

    /**
     * Vérifie qu'il n'y a pas de tags HTML ou PHP, ou qu'ils on été autorisés
     *
     * @param  String $var
     * @return bool
     */
	public function isValid($var){
        return strlen($var) == strlen(strip_tags($var, $this->strips_allowed));
	}


	////SETTERS

    /**
     * Exemple : '<h3><p><ul><li>'
     *
     * @param String $strips
     */
	public function setStripsAllowed(String $strips){
        $this->strips_allowed = $strips;
    }


    ////GETTERS

    /**
     * @return string
     */
    public function getStripsAllowed(){
	    return $this->strips_allowed;
    }
	
}