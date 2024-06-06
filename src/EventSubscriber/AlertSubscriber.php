<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\Alerte;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class AlertSubscriber implements EventSubscriberInterface
{ public $manager;
   
    public function __construct(EntityManagerInterface $manager)
    {   
        $this->manager = $manager;
    }
    public function onPanneAlert(Event $event): void
    {
        // ...
        $this->createAlert('Panne', 'Une panne a été détectée');
        // $this->flashBag->add('alert', 'Alerte de type ');
    }
    public function onVolAlert(Event $event): void
    {
        $this->createAlert('Vol', 'Un vol a été détecté');
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'alert.panne' => 'onPanneAlert',
            'alert.vol' => 'onVolAlert',
        ];
    }
    private function createAlert(string $type, string $contenu)
    {
        // Créez une nouvelle entrée d'alerte
        $alert = new Alerte();
        $alert->setType($type);
        $alert->setContenu($contenu);
        // $alert->setStatus($status);
        $alert->setDate(new \DateTime());

        // Sauvegardez-la dans la base de données
        $this->manager->persist($alert);
        $this->manager->flush();
    }
}
