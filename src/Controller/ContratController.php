<?php
// src/Controller/ContratController.php
// src/Controller/ContratController.php

namespace App\Controller;

use App\Entity\Contrat;
use App\Repository\ContratRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContratController extends AbstractController
{
    private $userRepository;
    private $contratRepository;
    private $entityManager;

    public function __construct(UserRepository $userRepository, ContratRepository $contratRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->contratRepository = $contratRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/contrat/new", name="contrat_new")
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('User not found');
        }

        $contrat = new Contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contrat->setUser($user);
            $this->entityManager->persist($contrat);
            $this->entityManager->flush();

            return $this->redirectToRoute('contrat_list');
        }

        return $this->render('contrat/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contrats", name="contrat_list")
     */
    public function list(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('User not found');
        }

        // Using the repository method directly
        $contrats = $this->contratRepository->findByUser($user);

        // Or using QueryBuilder method if you need more customization
        // $qb = $this->contratRepository->getContractsByUserQueryBuilder($user);
        // $contrats = $qb->getQuery()->getResult();

        return $this->render('contrat/list.html.twig', [
            'contrats' => $contrats,
        ]);
    }
}

