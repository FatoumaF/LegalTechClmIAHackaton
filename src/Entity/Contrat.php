<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre ;
    
    #[ORM\Column(type: 'text')]
    private $description ;


    #[ORM\Column(type: 'datetime')]
    private $dateDebut;

    #[ORM\Column(type: 'datetime')]
    private $dateFin;

    #[ORM\Column(type: 'string', length: 255)]
    private $partiesImpliquées;

    #[ORM\Column(type: 'string', length: 50)]
    private $statut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre ): self
    {
        $this->titre=$titre;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription(string $description):self
    {
        $this->description =$description;
        return $this;
    }

    public function getdateDebut():?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setdateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut= $dateDebut;
        return $this;
    }

    public function getdateFin():?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setdateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin=$dateFin;
        return $this;
    }
   public function getpartiesImpliquées(): ?string
   {
    return $this->partiesImpliquées;
   }
   public function setpartiesImpliquées(string $partiesImpliquées): self
   {
        $this->partiesImpliquées=$partiesImpliquées;
        return $this;
   }

   public function getStatut(): ?string
   {
    return $this->statut;
   }

   public function setStatut(string $statut): self
   {
    $this->statut=$statut;
    return $this;
   }
}

