<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
// toutes les méthodes pour faire des query a la bdd
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // méthode pour sauvegardé une entité dans la base de donnée
    public function saveUser(User $entity, bool $flush = false): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        

    }

    //méthode pour supprimer une entité d'une base de donnée
    public function remove(User $entity,bool $flush= false ) : void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    
    public function findOneId(){
        return $this->createQueryBuilder('u')
        ->andWhere('email ');
        

    }

    // public function findOneId(string $id):?User
    // {
    //     return $this->createQueryBuilder('u')
    //     ->select('* FROM u')
    //     ->andWhere('u.id= :id')
    //     ->setParameter('id', $id)
    //     ->getQuery()
    //     ->getOneOrNullResult();
        

    // }

    public function findAllUsers(): array
{
    return $this->findAll();
}
    public function getByEmail(string $email):?User 
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }
        

    }
//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

