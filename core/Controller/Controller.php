<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 01/10/17
 * Time: 19:10
 */

namespace Core\Controller;


abstract class Controller
{

    public function forbidden(){
        header('HTTP/1.0 403 Forbidden');
        die('Acces interdit');
    }

    public function notFound(){
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }

}