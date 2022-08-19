<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_prise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_reprise;

    /**
     * @ORM\Column(type="date")
     */
    private $date_prise;

    /**
     * @ORM\Column(type="date")
     */
    private $date_reprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heure_prise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heure_reprise;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_voiture;

    /**
     * @ORM\ManyToOne(targetEntity=Conducteur::class, inversedBy="id_reserveation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $conducteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieuPrise(): ?string
    {
        return $this->lieu_prise;
    }

    public function setLieuPrise(string $lieu_prise): self
    {
        $this->lieu_prise = $lieu_prise;

        return $this;
    }

    public function getLieuReprise(): ?string
    {
        return $this->lieu_reprise;
    }

    public function setLieuReprise(string $lieu_reprise): self
    {
        $this->lieu_reprise = $lieu_reprise;

        return $this;
    }

    public function getDatePrise(): ?\DateTimeInterface
    {
        return $this->date_prise;
    }

    public function setDatePrise(\DateTimeInterface $date_prise): self
    {
        $this->date_prise = $date_prise;

        return $this;
    }

    public function getDateReprise(): ?\DateTimeInterface
    {
        return $this->date_reprise;
    }

    public function setDateReprise(\DateTimeInterface $date_reprise): self
    {
        $this->date_reprise = $date_reprise;

        return $this;
    }

    public function getHeurePrise(): ?string
    {
        return $this->heure_prise;
    }

    public function setHeurePrise(string $heure_prise): self
    {
        $this->heure_prise = $heure_prise;

        return $this;
    }

    public function getHeureReprise(): ?string
    {
        return $this->heure_reprise;
    }

    public function setHeureReprise(string $heure_reprise): self
    {
        $this->heure_reprise = $heure_reprise;

        return $this;
    }

    public function getIdVoiture(): ?Voiture
    {
        return $this->id_voiture;
    }

    public function setIdVoiture(?Voiture $id_voiture): self
    {
        $this->id_voiture = $id_voiture;

        return $this;
    }

    public function getConducteur(): ?Conducteur
    {
        return $this->conducteur;
    }

    public function setConducteur(?Conducteur $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    public function __toString(): string {
        return $this->getId();
    }
}
