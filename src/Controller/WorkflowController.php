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

    private function getWorkflow(Contrat $contrat): WorkflowInterface
    {
        return $this->workflowRegistry->get($contrat);
    }

    #[Route('/contract/{id}/submit-revision', name: 'contract_submit_revision')]
    public function submitRevision(int $id): Response
    {
        $contrat = $this->contratRepository->find($id);

        if (!$contrat) {
            throw $this->createNotFoundException('Contract not found');
        }

        $workflow = $this->getWorkflow($contrat);

        if ($workflow->can($contrat, 'submit_revision')) {
            $workflow->apply($contrat, 'submit_revision');
            $this->entityManager->flush();
            $this->addFlash('success', 'Contract submitted for revision.');
        } else {
            $this->addFlash('error', 'Transition not allowed.');
        }

        return $this->redirectToRoute('admin_dashboard');
    }

    #[Route('/contract/{id}/approve', name: 'contract_approve')]
    public function approve(int $id): Response
    {
        $contrat = $this->contratRepository->find($id);

        if (!$contrat) {
            throw $this->createNotFoundException('Contract not found');
        }

        $workflow = $this->getWorkflow($contrat);

        if ($workflow->can($contrat, 'approve_contract')) {
            $workflow->apply($contrat, 'approve_contract');
            $this->entityManager->flush();
            $this->addFlash('success', 'Contract approved.');
        } else {
            $this->addFlash('error', 'Transition not allowed.');
        }

        return $this->redirectToRoute('admin_dashboard');
    }

    #[Route('/contract/{id}/sign', name: 'contract_sign')]
    public function sign(int $id): Response
    {
        $contrat = $this->contratRepository->find($id);

        if (!$contrat) {
            throw $this->createNotFoundException('Contract not found');
        }

        $workflow = $this->getWorkflow($contrat);

        if ($workflow->can($contrat, 'sign_contract')) {
            $workflow->apply($contrat, 'sign_contract');
            $this->entityManager->flush();
            $this->addFlash('success', 'Contract signed.');
        } else {
            $this->addFlash('error', 'Transition not allowed.');
        }

        return $this->redirectToRoute('admin_dashboard');
    }

    #[Route('/contract/{id}/complete', name: 'contract_complete')]
    public function complete(int $id): Response
    {
        $contrat = $this->contratRepository->find($id);

        if (!$contrat) {
            throw $this->createNotFoundException('Contract not found');
        }

        $workflow = $this->getWorkflow($contrat);

        if ($workflow->can($contrat, 'complete_contract')) {
            $workflow->apply($contrat, 'complete_contract');
            $this->entityManager->flush();
            $this->addFlash('success', 'Contract completed.');
        } else {
            $this->addFlash('error', 'Transition not allowed.');
        }

        return $this->redirectToRoute('admin_dashboard');
    }
}
