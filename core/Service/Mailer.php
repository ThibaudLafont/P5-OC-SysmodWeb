<?php
namespace Core\Service;

/**
 * Class Mailer
 * @package Core\Service
 *
 * Classe d'interaction avec Swift_Mailer
 * Permet son initialisation et l'envoi d'un message au format souhaité
 */
abstract class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer){
        $this->setMailer($mailer);
    }


    ////ABSTRACT

    /**
     * Définition du format du message au cas par cas et envoi
     *
     * @param $sender_name  Nom de l'expéditeur
     * @param $sender_mail  Mail de l'expéditeur
     * @param $mail_content Contenu du mail
     */
    public abstract function send($sender_name, $sender_mail, $mail_content);


    ////SETTERS

    /**
     * @param \Swift_Mailer $mailer
     */
    public function setMailer(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }


    ////GETTERS

    /**
     * @return \Swift_Mailer
     */
    public function getMailer(){
        return $this->mailer;
    }

}
