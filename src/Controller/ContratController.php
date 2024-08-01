<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Entity\Tache;
use App\Entity\Document;
use App\Form\ContratType;
use App\Repository\ContratRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class ContratController extends  AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contrat::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('description'),
            DateField::new('dateDebut'),
            DateField::new('dateFin'),
            TextField::new('partiesImpliquees'),
            TextField::new('statut'),
        


            #AssociationField::new('documents'),
           # AssociationField::new('tasks'),
            # Ajoutez d'autres champs selon vos besoins
        ];
    }
}
