<?php

namespace App\Controller;

use App\Entity\Document;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Security;
use App\Form\DocumentUploadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class DocumentController extends AbstractCrudController
{
    private Security $security;
    private string $uploadDirectory;

    public function __construct(Security $security, ParameterBagInterface $params)
    {
        $this->security = $security;
        $this->uploadDirectory = $params->get('upload_directory');
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

            // Afficher les fichiers en mode index
            TextField::new('fichiers')
                ->onlyOnIndex()
                ->setLabel('Fichiers')
                ->formatValue(fn($value) => $value ? implode(', ', explode(',', $value)) : ''),

            // Utiliser un formulaire personnalisé pour l'upload des fichiers
            FormField::addPanel('Documents')->onlyOnForms(),
            TextField::new('fichiers')
                ->setFormType(DocumentUploadType::class)
                ->setLabel('Télécharger des fichiers')
                ->onlyOnForms(),
        ];
    }

    /**
 * @Route("/upload", name="app_document_upload", methods={"POST"})
 */
public function uploadFileAction(Request $request, EntityManagerInterface $entityManager): Response
{
    $document = new Document();
    $form = $this->createForm(DocumentUploadType::class, $document);  // Lié à l'entité Document
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        /** @var UploadedFile[] $files */
        $files = $form->get('fichiers')->getData();  // Tableau de fichiers

        if ($files) {
            $filePaths = [];
            foreach ($files as $file) {
                $fileName = uniqid() . '.' . $file->guessExtension();
                try {
                    $file->move($this->uploadDirectory, $fileName);
                    $filePaths[] = $fileName;
                } catch (FileException $e) {
                    // Gérer l'exception en cas de problème de téléchargement
                    $this->addFlash('danger', 'Erreur lors du téléchargement du fichier.');
                }
            }
            // Stocker les chemins de fichiers en JSON
            $document->setFichiers($filePaths);
            $entityManager->persist($document);
            $entityManager->flush();

            $this->addFlash('success', 'Document uploadé avec succès.');
            return $this->redirectToRoute('app_document_index');
        }
    }

    return $this->render('document/upload.html.twig', [
        'form' => $form->createView(),
    ]);
}
}