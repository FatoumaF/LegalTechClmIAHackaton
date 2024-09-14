<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
#[Vich\Uploadable]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $titre = '';

    /**
     * @Vich\UploadableField(mapping="contrat_files", fileNameProperty="documentName")
     * @Assert\File(mimeTypes={"application/pdf", "application/msword"})
     */
    private ?File $contratFile = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $documentName = null;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dateDebut;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dateFin;

    #[ORM\Column(type: 'string', length: 255)]
    private string $partiesImpliquees;

    #[ORM\Column(type: 'string', length: 50)]
    private string $statut;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'contrats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDateDebut(): \DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    public function getDateFin(): \DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    public function getPartiesImpliquees(): string
    {
        return $this->partiesImpliquees;
    }

    public function setPartiesImpliquees(string $partiesImpliquees): self
    {
        $this->partiesImpliquees = $partiesImpliquees;
        return $this;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    /**
     * @param File|null $contratFile
     */
    public function setContratFile(?File $contratFile = null): void
    {
        $this->contratFile = $contratFile;

        if ($contratFile !== null) {
            // Met à jour la date pour forcer la mise à jour de l'entité
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getContratFile(): ?File
    {
        return $this->contratFile;
    }

    public function getDocumentName(): ?string
    {
        return $this->documentName;
    }

    public function setDocumentName(?string $documentName): void
    {
        $this->documentName = $documentName;
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
}
