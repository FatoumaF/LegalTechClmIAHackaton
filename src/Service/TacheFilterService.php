<?php

// src/Service/TacheFilterService.php

namespace App\Service;

use App\Entity\Tache;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class TacheFilterService
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function getFilteredTacheQueryBuilder()
    {
        $user = $this->security->getUser();
        
        if (!$user) {
            throw new \Exception('User not found.');
        }

        // Création du QueryBuilder pour filtrer les tâches
        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('t')
            ->from(Tache::class, 't')
            ->where('t.user = :user')
            ->setParameter('user', $user);

        return $queryBuilder;
    }
}
