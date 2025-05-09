<?php

namespace App\EventSubscriber;

use App\Entity\Membre;
use App\Entity\Subgroup;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PostRemoveEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class DatabaseActivitySubscriber implements EventSubscriberInterface
{

    public function __construct(private KernelInterface $kernel, private LoggerInterface $logger)
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postRemove => 'postRemove',
        ];
    }

    public function postRemove(PostRemoveEventArgs $args)
    {
        $this->logActivity('remove',$args->getObject());
    }

    public function logActivity(string $action, mixed $entity)
    {
        if ($action === 'remove') {
            $publicDir = $this->kernel->getProjectDir() . '/public/uploads/';
            
            if ($entity instanceof Membre) {
                $filename = $entity->getPhoto();
                $filePath = $publicDir . 'membre/' . $filename;
            } elseif ($entity instanceof Subgroup) {
                $filename = $entity->getLogo();
                $filePath = $publicDir . 'subgroup/' . $filename;
            } else {
                $this->logger->warning("Entité non prise en charge pour la suppression de fichier.");
                return;
            }

            if (!empty($filename) && file_exists($filePath)) {
                try {
                    unlink($filePath);
                    $this->logger->info("Fichier supprimé : " . $filePath);
                } catch (\Exception $e) {
                    $this->logger->error("Erreur lors de la suppression du fichier : " . $e->getMessage());
                }
            } else {
                $this->logger->warning("Fichier introuvable ou nom de fichier vide : " . $filePath);
            }
        }
    }
}


