<?php


namespace App\Controller;

use App\Entity\Document;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use Symfony\Component\Security\Core\Security;

class DocumentController extends AbstractCrudController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getEntityFqcn(): string
    {
        return Document::class;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entity): void
    {
        if ($entity instanceof Document) {
            $user = $this->security->getUser();  // Retrieve the currently logged-in user
            if ($user) {
                $entity->setUser($user);  // Associate the user with the document
            }
        }
        parent::persistEntity($entityManager, $entity);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('description'),
            DateField::new('dateCreation'),
            DateField::new('dateDeModification'),
            TextField::new('type'),
            TextField::new('fichier'),
            TextField::new('contratAssocie'),
            TextField::new('statut'),
            // Add other fields as needed
        ];
    }
}
