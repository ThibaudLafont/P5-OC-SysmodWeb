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

    protected $entity,
              $form,
              $closure;

    public function __construct(Callable $closure){
        $this->setEntity();
        $this->setForm();
        $this->setClosure($closure);
    }

    public abstract function setEntity();
    public abstract function setForm();
    public function setClosure(Callable $closure){
        $this->closure = $closure;
    }

    public function getEntity(){
        return $this->entity;
    }
    public function getForm(){
        return $this->form;
    }
    public function getClosure(){
        return $this->closure;
    }

    public function entityParams($params_name){
        $fields = [];

        if($_SERVER['REQUEST_METHOD'] !== 'POST') return $fields;

        foreach($params_name as $v){
            $fields[$v] = isset($_POST[$v]) ? $_POST[$v] : '';
        }

        return $fields;
    }

    public function process(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $form = $this->getForm();
            $form->validate();
            if($form->isValid()){
                $entity = $this->getEntity();
                call_user_func($this->closure, $entity);
            }
        }
    }

}