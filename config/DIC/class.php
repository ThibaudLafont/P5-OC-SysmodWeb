<?php
return
[
//Classes externes
    //Natives
    /////////
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
    ////////
    /// Twig
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
    /// SwiftMailer
    'Swift\Transport' => function(){
        $transport = new \Swift_SmtpTransport(
            $this->get('smtp_host'),
            $this->get('smtp_port'),
            $this->get('mail_protocol')
        );

        return $transport
            ->setUsername($this->get('mail_user'))
            ->setPassword($this->get('mail_pass'))
            ;
    },
    'Swift\Mailer' => function(){
        return new \Swift_Mailer($this->get('Swift\Transport'));
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

    //Service
    'Router' => function(){
        return new \App\Service\Router($this);
    },
    'Service\Mailer' => function(){
        return new \App\Service\Mailer($this->get('Swift\Mailer'));
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
        return new \App\Service\Form\Handler\Contact($this->get('Service\Mailer'));
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
    }
];
