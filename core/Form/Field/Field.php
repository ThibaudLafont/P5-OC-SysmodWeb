<?php
namespace Core\Form\Field;

abstract class Field{

	protected $name,
			  $label,
			  $value,
			  $validators = [], 
			  $errorMessage;

	public function __construct($options){
		$this->hydrate($options);
	}

	public function hydrate($options){
		foreach($options as $k => $v){
			$method = 'set' . ucfirst($k);
			if(method_exists($this, $method)){
				$this->$method($v);
			}
		}
	}

	public function isValid(){
		$validators = $this->validators;
		if(!empty($validators)){
			foreach($validators as $validator){
				if(!$validator->isValid($this->getValue())){
					$this->errorMessage = $validator->getErrorMessage();
					return false;
				}
			}
		}
		return true;
	}

	protected function buildLabelView(){
		$html = '';
		if($this->getLabel() !== null){
			$html .= '<label>'. $this->getLabel() .'</label><br/>';
		}
		return $html;
	}
	
	protected function buildErrorView(){
		$html = '';
		if($this->getErrorMessage() !== null){
			$html .= '<span>' . $this->getErrorMessage() . '</span>';
		}
		return $html;
	}

	public function setName($name){
		$this->name = $name;
	}
	public function setLabel($label){
		$this->label = $label;
	}
	public function setValue($value){
		$this->value = $value;
	}
	public function setValidators($validators){
	    foreach ($validators as $validator){
	    	if ($validator instanceof \Core\Form\Validator\Validator && !in_array($validator, $this->validators)){
	    		$this->validators[] = $validator;
	    	}
	    }
	}

	public function getName(){
		return $this->name;
	}
	public function getLabel(){
		return $this->label;
	}
	public function getValue(){
		return $this->value;
	}
	public function getErrorMessage(){
		return $this->errorMessage;		
	}

}