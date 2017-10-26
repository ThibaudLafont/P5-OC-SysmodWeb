# Blog PHP   
### Projet 5 de la formation développeur d'applications PHP -- OpenClassrooms

Ce projet a pour but de créer un blog et portfolio administrable. 
Il n'utilisera pas de framework PHP et sera codé selon le modèle MVC.

Ce readme est composé de deux parties, les consignes d'installation puis des informations 
sur l'organisation du code.

#### Consignes d'installation : 
Suivez les deux étapes ci-dessous pour implémenter le projet sur votre serveur

##### Paramétrage du serveur
Le site a pour répertoire web /public, et toute requête HTTP ne conduisant pas à un fichier 
existant doit être redirigée vers /public/index.php. Suivez la procédure ci-dessous pour 
le paramétrage d'un serveur Apache2   
- La définition de /public comme racine du serveur web  

    1. Ouvrez le fichier de configuration du vhost sur lequel vous déploierez le site. 
    
    2. Modifiez le chemin du `DocumentRoot`
    
            DocumentRoot  /path/to/web/root/public
        
- Il faut maintenant définir la redirection automatique vers index.php. 

        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^(.*)$ /index.php [QSA,L]   
    
    Vous pouvez écrire ces lignes soit :
    
    - dans un .htaccess à la racine du serveur 
     
    - dans le fichier de configuration d'apache
        
            <Directory /path/to/web/root/public>
            
                //Put the rewrite rules given below
                
            </Directory>   

##### Implémentation du code
- Le site utilise MySQL comme SGBD.  
  Vous pouvez télécharger un jeu de données pour la base SQL [ici](https://sysmod-web.fr/download/db_sysweb.sql), et l'importer sur votre serveur
- Téléchargez ou clonez ce dépot github.   
- Rendez vous dans /config/DIC/config.php et modifiez les différentes variables pour qu'elles correspondent à votre environnement.  

        ->PDO        
        
        'db_host'  => 'SQLhost',  //Hote SGBD
        'db_name'  => 'BDDname',  //Nom de la base
        'db_user'  => 'BDDuser',  //User SGBD
        'db_pass'  => 'password', //Password SGBD
            
        
        ->SWIFTMAILER
        
        'smtp_host'     => 'smtp.exemple.com', //Serveur SMTP de votre client mail
        'smtp_port'     => '465',              //Port de votre client mail
        'mail_protocol' => 'ssl',              //Protocole mail utilisé par votre client
        'mail_user'     => 'mail@mail.com',    //Où seront envoyés les mails de contact
        'mail_pass'     => 'password',         //Password de votre mail
        
#### Lecture du projet
            
Trois dépendances ont été utilisées :   
- TWIG           _ Générateur de templates  
- SwiftMailer    _ Module Symphony d'envoi de mail 
- Bootstrap      _ Framework CSS

##### Organisation du code 

- Fichiers :   

        /app       : Classes spécifiques à l'application   
        /config    : Fichiers de configuration et de définitions de dépendances   
        /core      : Classes générales   
        /diagramme : diagrammes UML du projet   
        /public    : Fichiers HTML/CSS/JS/DOWNLOABLE/IMG   
        /vendor    : Dépendances exterieures   

- Les classes ont la structure suivante :   

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
            
    (Chacune des sous-sections de méthodes est classée par ordre alphabétique) 