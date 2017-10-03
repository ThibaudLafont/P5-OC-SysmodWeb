<?php
namespace Core\Model\Form\Field;

class Text extends Field{

	private $cols,
			$rows;

	public function buildModule(){
		$html = "<label>{$this->getLabel()}</label><br/>
				 <textarea name='{$this->getName()}' rows='{$this->getRows()}' cols='{$this->getCols()}'>";
		if($this->getValue() !== ''){
			$html .= $this->getValue();
		}
		$html .= '</textarea>';
		$html .= $this->buildErrorView(); 

		return $html;
	}

	public function setCols($cols){
		$this->cols = $cols;
	}
	public function setRows($rows){
		$this->rows = $rows;
	}

	public function getCols(){
		return $this->cols;
	}
	public function getRows(){
		return $this->rows;
	}

}