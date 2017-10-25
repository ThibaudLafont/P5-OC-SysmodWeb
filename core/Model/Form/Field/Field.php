<?php
namespace Core\Model\Form\Field;

/**
 * Class Field
 *
 * Représente un champs de formulaire, stocke des \Core\Service\Validator\Validator pour validation des valeurs fournies
 */
abstract class Field{

    /**
     * @var String $name         Nom du champs   (pour construction HTML)
     * @var String $label        Label du champs (pour construction HTML)
     * @var String $value        Valeur du champs
     * @var Array  $validators   Tableau contenant des instances de \Core\Service\Validator\Validator
     * @var String $errorMessage Message d'erreur à afficher, qui sera récupéré d'un index de $validators
     */
    protected $name,
              $label,
              $value,
              $validators = [],
              $errorMessage;


    /**
     * Execute $this->hydrate si des données sont fournies
     * Permet une instanciation sous forme de tableau, très claire
     *
     * @param array $options Valeurs pour les attributs de field
     */
    public function __construct($options){
        $this->hydrate($options);
    }


    ////ABSTRACT

    /**
     * Contruit dynamiquement la vue (avec/sans erreur, value et label)
     * abstract implementation
     *
     * @return HTML|string
     */
    public abstract function buildModule();


    ////METHODS

    /**
     * Construit et retourne l'erreur si on a demandé auparavant la validation, null sinon
     *
     * @return HTML|null
     */
    protected function buildErrorView(){
        $html = '';
        if($this->getErrorMessage() !== null){
            $html .= '<span class="red">' . $this->getErrorMessage() . '</span>';
        }
        return $html;
    }

    /**
     * Construit et retourne le label
     *
     * @return HTML
     */
    protected function buildLabelView(){
        $html = '';
        if($this->getLabel() !== null){
            $html .= '<label>'. $this->getLabel() . "<br/>";
            $html .= $this->buildErrorView();
            $html .= '</label>';
        }
        return $html;
    }

    /**
     * Assigne dynamiquement les valeurs aux attributs du field
     *
     * @param array $options Valeurs pour les attributs du field
     */
    public function hydrate($options){
        foreach($options as $k => $v){
            $method = 'set' . ucfirst($k);
            if(method_exists($this, $method)){
                $this->$method($v);
            }
        }
    }

    /**
     * Execute un à un les validators stockés dans l'attribut $validators
     * Le cas échéant, s'arrête au premier critère non respecté et stocke le message du validator en attribut
     *
     * @return bool True si la valeur est valide, false autrement
     */
    public function validate(){
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


    ////GETTERS

    /**
     * @return String Message d'erreur
     */
    public function getErrorMessage(){
        return $this->errorMessage;
    }

    /**
     * @return String Valeur du label
     */
    public function getLabel(){
        return $this->label;
    }

    /**
     * @return String Nom du champs
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return String Valeur du champs
     */
    public function getValue(){
        return $this->value;
    }


    ////SETTERS

    /**
     * @param String|null $label
     */
    public function setLabel($label){
        $this->label = $label;
    }

    /**
     * @param String $name
     */
    public function setName(String $name){
        $this->name = $name;
    }

    /**
     * Controle et assigne $this->validators
     *
     * @param array $validators Tableau contenant des instances de \Core\Service\Validator\Validator
     */
    public function setValidators(Array $validators){
        foreach ($validators as $validator){
            if ($validator instanceof \Core\Service\Validator\Validator && !in_array($validator, $this->validators)){
                $this->validators[] = $validator;
            }
        }
    }

    /**
     * @param String|null $value
     */
    public function setValue($value){
        $this->value = $value;
    }

}