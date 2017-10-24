<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 24/10/17
 * Time: 11:41
 */

namespace Core\Service;


class Mailer
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->setMailer($mailer);
    }

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

    public function getMailer(){
        return $this->mailer;
    }
    public function setMailer(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }
}