<?php
namespace Core\Model\Form;

use Core\Model\Entity\Entity;

class Form{

    private $entity,
        $fields = [],
        $isValid,
        $validatedMessage =
        [
            'error'   => 'Il y a des erreurs dans le formulaire',
            'success' => 'Le formulaire a bien été soumis'
        ];

    private $surround = 'p';

    private function surround($html){
        $tag = $this->surround;
        $html = "<{$tag}>{$html}</{$tag}>";
        return $html;
    }

    public function __construct(Entity $entity){
        $this->setEntity($entity);
    }

    public function addField(\Core\Model\Form\Field\Field $field){
        $getter = 'get' . ucfirst($field->getName());
        $field->setValue($this->getEntity()->$getter());
        $this->fields[] = $field;
        return $this;
    }

    public function validate(){
        $valid = true;
        foreach($this->fields as $field){
            if(!$field->validate()) $valid = false;
        }
        return $valid;
    }

    public function buildView(){
        $html = '';

        $html .= "<p>{$this->getValidatedMessage()}</p>";

        foreach($this->fields as $field){
            $html .= $this->surround($field->buildModule());
        }

        return $html;
    }

    public function setEntity(Entity $entity){
        $this->entity = $entity;
    }
    public function setIsValid($valid){
        if(is_bool($valid)) $this->isValid = $valid;
    }
    public function setValidatedMessage($message, $type){
        $valid_type = ['success', 'error'];
        if(in_array($type, $valid_type)) $this->validatedMessage[$type] = $message;
    }

    public function getEntity(){
        return $this->entity;
    }
    public function getIsValid(){
        return $this->isValid;
    }
    public function getValidatedMessage(){
        $valid =$this->getIsValid();
        if(!is_null($valid)){
            if($valid === false) $key = 'error';
            else $key = 'success';
            return $this->validatedMessage[$key];
        }
        return '';
    }
}