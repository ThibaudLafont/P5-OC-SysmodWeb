# Blog PHP   
### Projet 5 de la formation développeur d'applications PHP -- OpenClassrooms

Ce projet a pour but de créer un blog et portfolio administrable. 
Il n'utilisera pas de framework PHP et sera codé selon le modèle MVC

#### Trois dépendances ont été utilisées :
- TWIG           _ Générateur de templates  
- SwiftMailer    _ Module Symphony d'envoi de mail 
- Bootstrap      _ Framework CSS

#### Consignes d'installation : 

- Le site utilise MySQL comme SGBD.  
  Vous pouvez télécharger un jeu de données pour la base SQL [ici](https://sysmod-web.fr/download/db_sysweb.sql), et l'importer sur votre serveur
- Téléchargez ou clonez ce dépot github. Votre serveur Web doit être apache et accepter les .htaccess
- Rendez vous dans /config/DIC/config.php et modifiez les différentes variables pour qu'elles correspondent à votre environnement.  

        ->PDO
        
            'db_host'  => 'labSQL',  //Hote SGBD
            'db_name'  => 'labBDD',  //Nom de la base
            'db_user'  => 'root',    //User SGBD
            'db_pass'  => 'pomme',   //Password SGBD
            
        
        ->SWIFTMAILER
        
            'smtp_host'         => 'smtp.gmail.com',   //Serveur SMTP de votre client mail
            'smtp_port'         => '465',              //Port de votre client mail
            'mail_protocol'     => 'ssl',              //Protocole mail utilisé par votre client
            
            'mail_user' => 'thiblaf10@gmail.com',      //Où seront envoyés les mails de contact
            'mail_pass' => '95pomme95',                //Password de votre mail
        
#### Lecture du code

- Struture :   
--/app : Classes spécifiques à l'application   
--/config : Fichiers de configuration et de définitions de dépendances   
--/core : Classes générales   
--/public : Fichiers HTML/CSS/JS/DOWNLOABLE/IMG   
--/vendor : Dépendances exterieures

- Vous pouvez trouver les diagrammes UML [de classe](https://sysmod-web.fr/download/uml_class_sysweb.png) et [de séquencce](https://sysmod-web.fr/download/seq_uml_sysweb.zip)

- Les classes suivent la structure suivante   
 (Chacune des sous-sections de méthodes est classée par ordre alphabétique) :

        <?php 
            //Namespace
            
            //Import des classes
            
            //Infos générales sur la classe
            class A{
                
                //Définition des attributs + construct
                
                //Méthodes abstraites
                
                //Méthodes spécifiques
                
                //SETTERS
                
                //GETTERS
                
            }