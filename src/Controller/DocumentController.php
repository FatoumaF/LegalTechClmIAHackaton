<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Repository\DocumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;



class DocumentController extends AbstractCrudController
// faire ses CREAT READ UPDATE ET DELETE
{ 
    public static function getEntityFqcn(): string
    {
        return Document::class;
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
        


            #AssociationField::new('documents'),
           # AssociationField::new('tasks'),
            # Ajoutez d'autres champs selon vos besoins
        ];
    }
    
}
