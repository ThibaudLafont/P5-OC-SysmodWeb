<?php
return
[
//Variables d'environnement
    'db_host' => 'labSQL',
    'db_name' => 'labBDD',
    'db_user' => 'root',
    'db_pass' => 'pomme',

    'viewsPath' => ROOT . '/app/Views',


//Classes externes
    //Natives
    'DateTimeZone' => function(){
        return new \DateTimeZone(
            'Europe/Paris'
        );
    },
    'DateTime' => function(){
        return new \DateTime(
            'now',
            $this->get('DateTimeZone')
        );
    },

    //Vendor
    'Twig\Loader' => function(){
        return new \Twig_Loader_Filesystem(
            $this->get('viewsPath')
        );
    },
    'Twig\Environnement' => function(){
        return new \Twig_Environment(
            $this->get('Twig\Loader'),
            array(
                'cache' => false,
                'debug' => true
            )
        );
    },


//Classes "maison"
    //Db
    'Pdo'     => function(){
        return new \Core\Model\Db\PDO(
            $this->get('db_host'),
            $this->get('db_name'),
            $this->get('db_user'),
            $this->get('db_pass')
        );
    },

    //Tables
    'Table\Show' => function(){
        return new \App\Model\Table\Show(
            $this->get('Pdo')
        );
    },
    'Table\Admin' => function(){
        return new \App\Model\Table\Admin(
            $this->get('Pdo'),
            $this->get('DateTime')
        );
    },

    //FormHandlers
    'Handler\Add' => function(){
        return new \App\Service\Form\Handler\Post\Add(
            $this->get('Table\Admin')
        );
    },
    'Handler\Edit' => function($slug){
        return new \App\Service\Form\Handler\Post\Edit(
            $this->get('Table\Admin'),
            $this->get('Table\Show'),
            $slug
        );
    },
    'Handler\Contact' => function(){
        return new \App\Service\Form\Handler\Contact(); //On y ajoutera SwiftMailer par la suite
    },

    //Controllers
    'Controller\Blog' => function(){
        return new \App\Controller\Blog(
            $this->get('Twig\Environnement'),
            $this->get('Handler\Contact')
        );
    },
    'Controller\Post\Show' => function(){
        return new \App\Controller\Post\Show(
            $this->get('Twig\Environnement'),
            $this->get('Table\Show')
        );
    },
    'Controller\Post\Manage' => function(){
        return new \App\Controller\Post\Manage(
            $this->get('Twig\Environnement')
        );
    },


//Call
    'Controller\Post\Add' => function(){
        $controller = $this->get('Controller\Post\Manage');
        $controller->add($this->get('Handler\Add'));
    },
    'Controller\Post\Edit' => function($slug){
        $controller = $this->get('Controller\Post\Manage');
        $controller->edit($this->get('Handler\Edit', $slug));
    }
];