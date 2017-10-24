<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 01/10/17
 * Time: 19:04
 */

namespace Core\Controller;

/**
 * Class Twig
 * @extends Core\Controller
 *
 * Controller implémentant le moteur de templates Twig
 *
 * Dependency : Twig_Environment
 */
abstract class Twig extends \Core\Controller\Controller
{

    /**
     * @var \Twig_Environment $twig
     */
    private $twig;

    /**
     * Assigne une instance de Twig en attribut
     *
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig){
        $this->setTwig($twig);
    }


    ////METHODS

    /**
     * Action à effectuer en cas de page non trouvée
     */
    public function notFound(){
        header('HTTP/1.0 404 Not Found');
        $title = 'Erreur 404';
        $this->render('Error/404', compact('title'));
    }

    /**
     * Injecte différentes variables dans la vue puis l'affiche
     *
     * @param String  $view      Chemin simplifié de la vue (sans .twig)
     * @param Array   $variables Variables nécessaires à la vue
     */
    protected function render($view, $variables){
        $view .= '.twig';
        echo $this->getTwig()->render($view, $variables);
    }


    ////GETTERS

    /**
     * @return \Twig_Environment
     */
    protected function getTwig(){
        return $this->twig;
    }


    ////SETTERS

    /**
     * @param \Twig_Environment $twig
     */
    protected function setTwig(\Twig_Environment $twig){
        $this->twig = $twig;
    }

}