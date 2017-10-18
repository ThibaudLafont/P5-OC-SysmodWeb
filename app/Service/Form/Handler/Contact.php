<?php
namespace App\Service\Form\Handler;


class Contact extends \Core\Service\Form\Handler
{

    public function POSTEntity()
    {
        $entity_params = $this->post2EntityParams(['name', 'email', 'content']);
        $entity = $this->buildEntity($entity_params);
        return $entity;
    }

    public function execute($entity)
    {
        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('thiblaf10@gmail.com')
            ->setPassword('95pomme95')
        ;

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Create a message
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
        $result = $mailer->send($message);
    }
}