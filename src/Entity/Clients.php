<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientsRepository::class)]
class Clients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DatedeNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $codepostal = null;

    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $FonctionDanslaSté = null;

    #[ORM\Column(length: 50)]
    private ?string $Sociéte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDatedeNaissance(): ?\DateTimeInterface
    {
        return $this->DatedeNaissance;
    }

    public function setDatedeNaissance(\DateTimeInterface $DatedeNaissance): self
    {
        $this->DatedeNaissance = $DatedeNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(int $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getFonctionDanslaSté(): ?string
    {
        return $this->FonctionDanslaSté;
    }

    public function setFonctionDanslaSté(?string $FonctionDanslaSté): self
    {
        $this->FonctionDanslaSté = $FonctionDanslaSté;

        return $this;
    }

    public function getSociéte(): ?string
    {
        return $this->Sociéte;
    }

    public function setSociéte(string $Sociéte): self
    {
        $this->Sociéte = $Sociéte;

        return $this;
    }
}
