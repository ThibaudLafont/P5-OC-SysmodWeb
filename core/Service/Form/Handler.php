<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 03/10/17
 * Time: 18:07
 */

namespace Core\Service\Form;

abstract class Handler
{

    protected $name,
              $form;

    public function process(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $entity = $this->getEntity();
        }else{
            $entity = $this->postEntity();
        }

        $this->setForm($entity);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($this->getForm()->validate()){
                $this->execute($entity);
            }
        }
    }

    public abstract function execute($entity);

    public abstract function POSTEntity();
    public function GETEntity()
    {
        $entity = $this->buildEntity();
        return new $entity;
    }
    public function buildEntity($entity_params = []){
        $entity_class = '\App\Model\Entity\\' . $this->getName();
        return new $entity_class($entity_params);
    }
    public function post2EntityParams(Array $datas){
        $fields = [];
        foreach($datas as $key){
            $fields[$key] = isset($_POST[$key]) ? $_POST[$key] : '';
        }
        return $fields;
    }

    public function setForm($entity)
    {
        $builder_class = '\App\Service\Form\Builder\\' . $this->getName();
        $formBuilder = new $builder_class($entity);

        $formBuilder->build();
        $form = $formBuilder->getForm();

        $this->form = $form;
    }
    public function getForm(){
        return $this->form;
    }

    public function setName(){
        $class = get_class($this); //Récupération du nom de la classe

        $needle_pos = strpos($class, 'Handler\\'); //Définition de la position du début du nom
        $needle_length = strlen('Handler\\');
        $start = $needle_pos+$needle_length;

        $name = substr($class, $start); //Troncature de chaine en fonction de la position du nom

        $end = strpos($name, '\\'); //On gère le cas où le Handler a hérité d'une autre classe abstraite que $this
        if($end) $name = substr($name, 0, $end);

        $this->name = $name;
    }
    public function getName(){
        if($this->name === null) $this->setName();
        return $this->name;
    }
}