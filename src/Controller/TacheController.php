<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;


class TacheController extends AbstractCrudController

{
    public static function getEntityFqcn(): string
    {
        return Tache::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->hideOnForm(),
            TextField::new('Titre'),
            TextField::new('Description'),
            BooleanField::new('Completed'), // Utiliser BooleanField pour un booléen
            DateField::new('dateCreation'),
            DateField::new('dateEcheance'),
            DateField::new('dateEcheance'),
            DateField::new('dateCompletion'),
            
        


            #AssociationField::new('documents'),
           # AssociationField::new('tasks'),
            # Ajoutez d'autres champs selon vos besoins
        ];
    }
}