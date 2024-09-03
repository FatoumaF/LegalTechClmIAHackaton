<?php
// src/Repository/ContratRepository.php

namespace App\Repository;

use App\Entity\Contrat;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Contrat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contrat[]    findAll()
 * @method Contrat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contrat::class);
    }

    /**
     * Find contracts by user using QueryBuilder.
     *
     * @param User $user
     * @return Contrat[]
     */
    public function findByUser(User $user): array
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.user = :user')
            ->setParameter('user', $user);

        return $qb->getQuery()->getResult();
    }

    /**
     * Find contracts by user with more complex conditions.
     *
     * @param User $user
     * @return QueryBuilder
     */
    public function getContractsByUserQueryBuilder(User $user): QueryBuilder
    {
        return $this->createQueryBuilder('c')
            ->where('c.user = :user')
            ->setParameter('user', $user)
            ->orderBy('c.dateDebut', 'DESC'); // Example of additional condition
    }
}


