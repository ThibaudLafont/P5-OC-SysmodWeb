<?php
namespace App\Service;

class Mailer extends \Core\Service\Mailer
{
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