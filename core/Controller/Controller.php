<?php
namespace Core\Controller;

/**
 * Class Controller
 *
 * Sert de base à tout controller
 */
abstract class Controller
{

    /**
     * Action à effectuer en cas de page non trouvée
     */
    public function forbidden(){
        header('HTTP/1.0 403 Forbidden');
        die('Acces interdit');
    }

    /**
     * Action à effectuer en cas de page non interdite
     */
    public function notFound(){
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }

}