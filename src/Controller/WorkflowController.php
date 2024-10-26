<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Repository\ContratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\WorkflowInterface;
use Doctrine\ORM\EntityManagerInterface;

class WorkflowController extends AbstractController
{
    private $entityManager;
    private $workflowRegistry;
    private $contratRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        Registry $workflowRegistry,
        ContratRepository $contratRepository
    ) {
        $this->entityManager = $entityManager;
        $this->workflowRegistry = $workflowRegistry;
        $this->contratRepository = $contratRepository;
    }

    
}
