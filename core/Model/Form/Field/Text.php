<?php
namespace Core\Model\Form\Field;

/**
 * Class Text
 * @package Core\Model\Form\Field
 *
 * Crée des textarea
 */
class Text extends Field{

    /**
     * @var int $cols Nombre de colonnes souhaitées
     * @var int $row Nombre de lignes souhaitées
     */
	private $cols,
			$rows;


	////METHODS

    /**
     * Contruit dynamiquement la vue (avec/sans erreur, value et label)
     * abstract implementation
     *
     * @return HTML|string
     */
	public function buildModule(){
		$html = "<label>
                    {$this->getLabel()}<br/>
                    {$this->buildErrorView()}
                 </label><br/>
				 <textarea id='{$this->getName()}' name='{$this->getName()}' rows='{$this->getRows()}' cols='{$this->getCols()}'>";
		if($this->getValue() !== ''){
			$html .= $this->getValue();
		}
		$html .= '</textarea>';

		return $html;
	}


	////SETTERS

    /**
     * @param Int $cols
     */
	public function setCols(Int $cols){
		$this->cols = $cols;
	}

    /**
     * @param Int $rows
     */
	public function setRows(Int $rows){
		$this->rows = $rows;
	}


	////GETTERS

    /**
     * @return int
     */
	public function getCols(){
		return $this->cols;
	}

    /**
     * @return int
     */
	public function getRows(){
		return $this->rows;
	}

}