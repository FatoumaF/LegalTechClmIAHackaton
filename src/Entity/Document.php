<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    private $titre;

    private $description;

    private $dateCreation;

    private $dateDeModification;

    private $type;

    private $fichier;

    private $contratAssocie;

    private $statut;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }
    public function setTitre(string $titre): self
    {
        $this->titre= $titre;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description= $description;
        return $this;
    }

    public function getdateCreation():?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setdateCreation(\DateTimeInterface $dateCreation)
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    public function getdateModification():?\DateTimeInterface
    {
        return $this->dateDeModification;
    }

    public function setdateModification(\DateTimeInterface $dateDeModification): self
    {
        $this->dateDeModification = $dateDeModification;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
    public function setType(string $type) :self
    {
        $this->type=$type;
        return $this;
    }

    public function getFichier():?string
    {
        return $this->fichier;
    }
    public function setFichier(string $fichier): self
    {
        $this->fichier =$fichier;
        return $this;
    }

    public function getcontratAssocie():?Contrat
    {
        return $this->contratAssocie;

    }

    public function setcontratAssocie(?Contrat $contratAssocie):self
    {
       $this->contratAssocie=$contratAssocie;
       return $this;
    }

    public function getStatut():?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut):self
    {
        $this->statut=$statut;
        return $this;
    }
}
