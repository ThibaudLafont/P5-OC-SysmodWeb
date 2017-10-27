<?php
namespace App\Service\Form\Handler;

//Uses
use Core\Service\Mailer;
use App\Model\Entity\Contact as ContactEntity;

/**
 * Class Contact
 * @package App\Service\Form\Handler
 */
class Contact extends \Core\Service\Form\Handler
{

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * Contact constructor.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer){
        $this->setMailer($mailer);
    }


    ////METHODS

    /**
     * @param ContactEntity $entity
     */
    public function execute($entity)
    {
        $sender_name= $entity->getName();
        $sender_mail = $entity->getEmail();
        $message_content = $entity->getContent();

        $this->getMailer()->send($sender_name, $sender_mail, $message_content);
    }

    /**
     * @return \App\Model\Entity\Contact
     */
    public function entityPost()
    {
        $entity_params = $this->post2EntityParams(['name', 'email', 'content']);
        $entity = $this->buildEntity($entity_params);
        return $entity;
    }


    ////SETTERS

    /**
     * @param Mailer $mailer
     */
    public function setMailer(Mailer $mailer){
        $this->mailer = $mailer;
    }


    ////GETTERS

    /**
     * @return Mailer
     */
    public function getMailer(){
        return $this->mailer;
    }

}
