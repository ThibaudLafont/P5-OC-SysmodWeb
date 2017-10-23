<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 01/10/17
 * Time: 19:04
 */

namespace Core\Controller;


abstract class Twig extends \Core\Controller\Controller
{

    private $twig;

    public function __construct(\Twig_Environment $twig){
        $this->twig = $twig;
    }

    public function notFound(){
        header('HTTP/1.0 404 Not Found');
        $title = 'Erreur 404';
        $this->render('Error/404', compact('title'));
    }

    public function render($view, $variables = null){
        $view .= '.twig';
        if($variables !== null){
            echo $this->twig->render($view, $variables);
        }else{
            echo $this->twig->render($view);
        }
    }

}