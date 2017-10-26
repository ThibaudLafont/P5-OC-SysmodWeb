<?php
namespace Core\Model\Form\Field;

/**
 * Class Input
 * @package Core\Model\Form\Field
 *
 * Crée des inputs de tous les types
 */
class Input extends Field{

    /**
     * @var string $type      Type d'input souhaité (text par défault)
     * @var int    $maxLength Nombre de caratères max pour construction HTML
     */
	protected $type ='text',
			  $maxLength;


	////METHODS

    /**
     * Contruit dynamiquement la vue (avec/sans erreur, value et label)
     * abstract implementation
     *
     * @return HTML|string
     */
	public function buildModule(){

		$html  = $this->buildLabelView();
		$html .= "<input id=\"{$this->getName()}\" type=\"{$this->getType()}\" name=\"{$this->getName()}\"";
		if($this->getMaxLength() !== null){
			$html .= " maxlength=\"{$this->getMaxLength()}\"";
		}
		if($this->getValue() !== null){
			$html .= " value=\"{$this->getValue()}\"";
		}
		$html .= '/>';

		return $html;
	}


	////SETTERS

    /**
     * @param Int $length
     */
	public function setMaxLength(Int $length){
		$this->maxLength = $length;
	}

    /**
     * @param String $type
     */
	public function setType(String $type){
		$this->type = $type;
	}


	////GETTERS

    /**
     * @return int
     */
	public function getMaxLength(){
		return $this->maxLength;
	}

    /**
     * @return string
     */
	public function getType(){
		return $this->type;
	}
}
