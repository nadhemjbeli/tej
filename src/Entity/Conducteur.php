<?php

namespace App\Entity;

use App\Repository\ConducteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConducteurRepository::class)
 */
class Conducteur
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero_vol;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="conducteur")
     */
    private $id_reserveation;

    public function __construct()
    {
        $this->id_reserveation = new ArrayCollection();
    }

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

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getNumeroVol(): ?string
    {
        return $this->numero_vol;
    }

    public function setNumeroVol(?string $numero_vol): self
    {
        $this->numero_vol = $numero_vol;

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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getIdReserveation(): Collection
    {
        return $this->id_reserveation;
    }

    public function addIdReserveation(Reservation $idReserveation): self
    {
        if (!$this->id_reserveation->contains($idReserveation)) {
            $this->id_reserveation[] = $idReserveation;
            $idReserveation->setConducteur($this);
        }

        return $this;
    }

    public function removeIdReserveation(Reservation $idReserveation): self
    {
        if ($this->id_reserveation->removeElement($idReserveation)) {
            // set the owning side to null (unless already changed)
            if ($idReserveation->getConducteur() === $this) {
                $idReserveation->setConducteur(null);
            }
        }

        return $this;
    }
}
