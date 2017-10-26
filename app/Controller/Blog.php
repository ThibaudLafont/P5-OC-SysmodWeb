<?php
namespace App\Controller;

//Uses
use App\Service\Form\Handler\Contact;

/**
 * Class Blog
 * @package App\Controller
 *
 * Extension spécialisée de \Core\Controller\Twig servant de controller pour l'affichage de l'index
 */
class Blog extends \Core\Controller\Twig {

    /**
     * @var Contact
     */
    private $handler;

    /**
     * Blog constructor.
     * @param \Twig_Environment $twig
     * @param Contact $handler
     */
    public function __construct(\Twig_Environment $twig, Contact $handler){
        parent::__construct($twig);
        $this->setHandler($handler);
    }


    ////METHODS

    /**
     * Lance le Handler
     * Construit le formulaire si pas de soumission ou soumission invalide
     * Rends la vue
     */
    public function index(){
        $this->handler->process();
        $form = $this->getHandler()->getForm()->buildView();

        $title = "Sysmod-Web";
        $this->render('Public/Index', compact('title', 'form'));
    }


    ////SETTERS

    /**
     * @param Contact $handler
     */
    public function setHandler(Contact $handler){
        $this->handler = $handler;
    }


    ////GETTERS

    /**
     * @return Contact
     */
    public function getHandler(){
        return $this->handler;
    }

}
