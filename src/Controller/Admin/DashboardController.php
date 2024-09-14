<?php

namespace App\Controller\Admin;

use App\Entity\Contrat;
use App\Entity\Tache;
use App\Entity\Document;
use App\Entity\Calendrier;
use App\Service\GoogleCalendarService; // Ajoutez ce service
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ContratRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Workflow\Registry;

class DashboardController extends AbstractDashboardController
{
    private $security;
    private $entityManager;
    private $workflowRegistry;
    private $contratRepository;
    private $googleCalendarService; // Ajoutez cette propriété

    public function __construct(Security $security, EntityManagerInterface $entityManager, Registry $workflowRegistry, ContratRepository $contratRepository)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->workflowRegistry = $workflowRegistry;
        $this->contratRepository = $contratRepository;
        //$this->googleCalendarService = $googleCalendarService; // Initialisez le service
    }

    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        $user = $this->security->getUser();
        
        if (!$this->security->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('Vous n\'avez pas accès à cette route.');
        }

        // Compter les tâches de l'utilisateur connecté
        $taskCount = $this->entityManager->getRepository(Tache::class)
            ->createQueryBuilder('t')
            ->select('COUNT(t.id)')
            ->where('t.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult();

        // Récupérer les contrats et leurs états
        $contrats = $this->entityManager->getRepository(Contrat::class)->findAll();
        $createdContracts = $this->contratRepository->findBy(['statut' => 'création']);
        $signedContracts = $this->contratRepository->findBy(['statut' => 'signé']);

        // Préparer les données pour le graphique
        $statuses = ['création', 'révision', 'approbation', 'signature', 'complété'];
        $statusCounts = array_fill_keys($statuses, 0);

        foreach ($contrats as $contrat) {
            $status = $contrat->getStatut();
            if (in_array($status, $statuses)) {
                $statusCounts[$status]++;
            }
        }

        // Définir les couleurs pour chaque statut
        $statusColors = [
            'création' => 'rgba(255, 99, 132, 0.2)', // Rouge
            'révision' => 'rgba(54, 162, 235, 0.2)', // Bleu
            'approbation' => 'rgba(255, 206, 86, 0.2)', // Jaune
            'signature' => 'rgba(75, 192, 192, 0.2)', // Vert
            'complété' => 'rgba(153, 102, 255, 0.2)' // Violet
        ];

        $statusBorderColors = [
            'création' => 'rgba(255, 99, 132, 1)',
            'révision' => 'rgba(54, 162, 235, 1)',
            'approbation' => 'rgba(255, 206, 86, 1)',
            'signature' => 'rgba(75, 192, 192, 1)',
            'complété' => 'rgba(153, 102, 255, 1)'
        ];

        $chartData = [
            'labels' => array_keys($statusCounts),
            'datasets' => [
                [
                    'label' => 'WorkFlow Overview',
                    'data' => array_values($statusCounts),
                    'backgroundColor' => array_map(function ($status) use ($statusColors) {
                        return $statusColors[$status];
                    }, array_keys($statusCounts)),
                    'borderColor' => array_map(function ($status) use ($statusBorderColors) {
                        return $statusBorderColors[$status];
                    }, array_keys($statusCounts)),
                    'borderWidth' => 1,
                ],
            ],
        ];

        $chartDataProgressionContrat = [
            'labels' => ['Créé', 'Signé'],
            'datasets' => [
                [
                    'label' => 'Contrats',
                    'data' => [
                        count($createdContracts),
                        count($signedContracts)
                    ]
                ]
            ]
        ];

        // Récupérer les événements Google Calendar
        
        return $this->render('admin/my-dashboard.html.twig', [
            'taskCount' => $taskCount,
            'chartData' => json_encode($chartData), // Encodez en JSON pour Twig
            'chartDataProgressionContrat' => json_encode($chartDataProgressionContrat), // Encodez en JSON pour Twig
          //  'events' => $eventsList, // Données des événements Google Calendar
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LegalTechClmProject');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linkToCrud('Contrats', 'fa fa-file-contract', Contrat::class);
        yield MenuItem::linkToCrud('Tâches', 'fa fa-list', Tache::class);
        yield MenuItem::linkToCrud('Documents', 'fa fa-file', Document::class);
        yield MenuItem::linkToCrud('Calendrier', 'fa fa-calendar', Calendrier::class);
        // Ajoutez d'autres éléments de menu si nécessaire
    }
}
