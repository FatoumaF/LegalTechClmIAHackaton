<?php

namespace App\Controller\Admin;

use App\Entity\Contrat;
use App\Entity\Document;
use App\Entity\Tache;
use App\Entity\Calendrier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractCrudController // DashboardController is just a normal controller. Though, it does extend AbstractDashboardController:
{
    public function __construct(
        private ChartBuilderInterface $chartBuilder,
        private Security $security
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if (!$this->security->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('Vous n\'avez pas accès à cette route.');
        }

        // $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);

        // return $this->render('admin/my-dashboard.html.twig', [
        //     'chart' => $chart,
        // ]);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
         return $this->render('admin/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle(title :'LegalTechClmProject'); //(-> ce sont les options lié au dashboard)
           
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Contrats', 'fa fa-file-contract', Contrat::class);
        yield MenuItem::linkToCrud('Documents', 'fa fa-file', Document::class);
        yield MenuItem::linkToCrud('Tache','fa fa-list', Tache::class);
       // yield MenuItem::linkToCrud('Calendrier','fa fa-calendar', Calendrier::class);
    }
}