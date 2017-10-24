<?php
namespace App\Service\Form\Handler;


class Contact extends \Core\Service\Form\Handler
{

    private $mailer;

    public function __construct(\Core\Service\Mailer $mailer){
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

        $this->getMailer()->send($sender_name, $sender_mail, $message_content);
    }

    public function getMailer(){
        return $this->mailer;
    }
    public function setMailer(\Core\Service\Mailer $mailer){
        $this->mailer = $mailer;
    }
}