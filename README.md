#Blog PHP 
#####Projet 5 de la formation développeur d'applications PHP -- OpenClassrooms

Ce projet a pour but de créer un blog et portfolio administrable. 
Il n'utilisera pas de framework PHP et sera codé selon le modèle MVC

Deux dépendances ont été utilisées :
- TWIG           _ Générateur de template  
- SwiftMailer   _ Module Symphony d'envoi de mail 

Consignes d'installation : 

- Téléchargez la base de données [a renseigner](https://sysmod-web/db), puis importez la sur votre serveur SQL.  
  Le site utilise MySQL comme SGBD.

- Téléchargez ou clonez ce dépot github.

- Rendez vous dans /config/config.php et modifiez les différentes variables pour qu'elles correspondent à votre environnement.  

        ->PDO
        
            'db_host'  => 'labSQL',  //Hote SGBD
            'db_name'  => 'labBDD',    //Nom de la base
            'db_user'  => 'root',    //User SGBD
            'db_pass'  => 'pomme',   //Password SGBD
            
        
        ->SWIFTMAILER
        
            'smtp_host'         => 'smtp.gmail.com',    //Serveur SMTP de votre client mail
            'smtp_port'         => '465',               //Port de votre client mail
            'mail_protocol'     => 'ssl',               //Protocole mail utilisé par votre client
            
            'mail_user' => 'thiblaf10@gmail.com',      //Où seront envoyés les mails de contact
            'mail_pass' => '95pomme95',                //Password de votre mail
        
 