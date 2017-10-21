<?php
namespace App\Service\Form\Handler;


class Contact extends \Core\Service\Form\Handler
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->setMailer($mailer);
    }

    public function POSTEntity()
    {
        $entity_params = $this->post2EntityParams(['name', 'email', 'content']);
        $entity = $this->buildEntity($entity_params);
        return $entity;
    }

    public function execute($entity)
    {
        $sender_name= $entity->getName();
        $sender_mail = $entity->getEmail();
        $message_content = $entity->getContent();

        $message = (new \Swift_Message($sender_name . ' cherche à te joindre'))
            ->setFrom([$sender_mail => $sender_name])
            ->setTo(['thiblaf10@gmail.com' => 'Thibaud Lafont'])
            ->setBody(
                "
                / Infos sur l'expéditeur /
                
                Nom : {$sender_name} 
                Mail : {$sender_mail}
                
                
                / Contenu /
                
                $message_content
                "
            );
        ;

        // Send the message
        $this->getMailer()->send($message);
    }

    public function getMailer(){
        return $this->mailer;
    }
    public function setMailer(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }
}