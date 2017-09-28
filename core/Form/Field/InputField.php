<?php
namespace Core\Form\Field;

class InputField extends Field{

	protected $type ='text',
			  $maxLength;

	public function buildModule(){

		$html  = $this->buildLabelView();
		$html .= "<input type=\"{$this->getType()}\" name=\"{$this->getName()}\"";
		if($this->getMaxLength() !== null){
			$html .= " maxlength=\"{$this->getMaxLength()}\"";
		}
		if($this->getValue() !== null){
			$html .= " value=\"{$this->getValue()}\"";
		}
		$html .= '/>';
		$html .= $this->buildErrorView(); 

		return $html;
	}

	public function setMaxLength($length){
		$this->maxLength = $length;
	}
	public function setType($type){
		$this->type = $type;
	}

	public function getMaxLength(){
		return $this->maxLength;
	}
	public function getType(){
		return $this->type;
	}
}