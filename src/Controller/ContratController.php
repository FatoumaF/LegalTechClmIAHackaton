<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Repository\ContratRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\VichFileField;

use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use Vich\UploaderBundle\Form\Type\VichFileType;



class ContratController extends AbstractCrudController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getEntityFqcn(): string
    {
        return Contrat::class;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entity): void
    {
        if ($entity instanceof Contrat) {
            $user = $this->security->getUser();  // Récupère l'utilisateur actuellement connecté
            if ($user) {
                $entity->setUser($user);  // Associe l'utilisateur au contrat
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
        DateField::new('dateDebut'),
        DateField::new('dateFin'),
        TextField::new('partiesImpliquees'),
        ChoiceField::new('statut')->setChoices([
            'Création' => 'création',
            'Révision' => 'révision',
            'Approbation' => 'approbation',
            'Signature' => 'signature',
            'Complété' => 'complété'
        ]),
    
    ];
}

    
}
