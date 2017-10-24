<?php
/**
 * Created by PhpStorm.
 * User: thib
 * Date: 24/10/17
 * Time: 11:41
 */

namespace Core\Service;


abstract class Mailer
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->setMailer($mailer);
    }

    public abstract function send($sender_name, $sender_mail, $mail_content);

    public function getMailer(){
        return $this->mailer;
    }
    public function setMailer(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }
}