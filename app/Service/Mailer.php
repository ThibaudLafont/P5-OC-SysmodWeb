<?php
namespace App\Service;

/**
 * Class Mailer
 * @package App\Service
 *
 * Spécialisation de \Core\Service\Mailer pour un formulaire de contact
 */
class Mailer extends \Core\Service\Mailer
{

    /**
     * @param \Core\Service\Nom     $sender_name  Nom expéditeur
     * @param \Core\Service\Mail    $sender_mail  Mail expéditeur
     * @param \Core\Service\Contenu $mail_content Contenu du mail
     */
    public function send($sender_name, $sender_mail, $mail_content){
        $message = (new \Swift_Message($sender_name . ' cherche à te joindre'))
            ->setFrom([$sender_mail => $sender_name])
            ->setTo(['thiblaf10@gmail.com' => 'Thibaud Lafont'])
            ->setBody("
                / Infos sur l'expéditeur /
                Nom  : {$sender_name} 
                Mail : {$sender_mail}
                
                
                / Contenu /
                
                $mail_content
            ");

        $this->getMailer()->send($message);
    }

}