<?php
// src/Controller/Admin/DashboardController.php

namespace App\Controller\Admin;

use App\Entity\Tache;
use App\Entity\Contrat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends AbstractDashboardController
{
    private $security;
    private $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    #[Route('/admin', name: 'admin')]
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

        return $this->render('admin/my-dashboard.html.twig', [
            'taskCount' => $taskCount,
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
        //yield MenuItem::linkToCrud('Calendrier', 'fa fa-calendar', Calendrier::class);
    }
}
