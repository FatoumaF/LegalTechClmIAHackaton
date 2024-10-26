<?php
namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Contrat;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $titre;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dateCreation;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $dateDeModification = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $type = null;

    
    #[ORM\ManyToOne(targetEntity: Contrat::class, inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Contrat $contratAssocie = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $statut = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $fichiers = '';


    private ?array $uploadedFiles = null;


    

    // Getters and Setters

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
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDateCreation(): \DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    public function getDateDeModification(): ?\DateTimeInterface
    {
        return $this->dateDeModification;
    }

    public function setDateDeModification(?\DateTimeInterface $dateDeModification): self
    {
        $this->dateDeModification = $dateDeModification;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function setFichiers(array $fichiers): self
    {
        $this->fichiers = $fichiers;
        return $this;
    }

    public function addFichier(string $fichier): self
    {
        $this->fichiers[] = $fichier;
        return $this;
    }

    public function getFichiers(): string
    {
        return $this->fichiers;
    }
    public function getUploadedFiles(): ?array
    {
        return $this->uploadedFiles;
    }

    public function setUploadedFiles(?array $uploadedFiles): self
    {
        $this->uploadedFiles = $uploadedFiles;
        return $this;
    }
    

    public function getContratAssocie(): ?Contrat
    {
        return $this->contratAssocie;
    }

    public function setContratAssocie(?Contrat $contratAssocie): self
    {
        $this->contratAssocie = $contratAssocie;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    // Getter and Setter for file property (used for handling uploads)
    
}
