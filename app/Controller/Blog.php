<?php
namespace App\Controller;

class Blog extends \Core\Controller\Twig {

    private $handler;

    public function __construct(\Twig_Environment $twig, \App\Service\Form\Handler\Contact $handler){
        parent::__construct($twig);
        $this->handler = $handler;
    }

    public function index(){
        $this->handler->process();
        $form = $this->handler->getForm()->buildView();

        $title = "Sysmod-Web";
        $this->render('index', compact('title', 'form'));
    }


}