<?php
// src/Controller/Admin/TacheCrudController.php

// src/Controller/Admin/TacheCrudController.php

namespace App\Controller\Admin;

use App\Entity\Tache;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class TacheCrudController extends AbstractCrudController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getEntityFqcn(): string
    {
        return Tache::class;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entity): void
    {
        if ($entity instanceof Tache) {
            $user = $this->security->getUser();  // Récupère l'utilisateur actuellement connecté
            if ($user) {
                $entity->setUser($user);  // Associe l'utilisateur à la tâche
            }
        }
        parent::persistEntity($entityManager, $entity);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('description'),
            BooleanField::new('completed'),
            DateField::new('dateCreation'),
            DateField::new('dateEcheance'),
            DateField::new('dateCompletion'),
        ];
    }
}

