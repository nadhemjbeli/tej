<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use DateInterval;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
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
    private $carburant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transmission;

    /**
     * @ORM\Column(type="integer")
     */
    private $puissance;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $agence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_jour;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="voitures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity=ImagesVoitures::class, mappedBy="voiture")
     */
    private $imagesVoitures;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\OneToOne(targetEntity=Prix::class, mappedBy="voiture", cascade={"persist", "remove"})
     */
    private $prix;

    private $prixActuel;

    public function __construct()
    {
        $this->imagesVoitures = new ArrayCollection();
        $this->setPrixActuel();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getAgence(): ?string
    {
        return $this->agence;
    }

    public function setAgence(string $agence): self
    {
        $this->agence = $agence;

        return $this;
    }
    public function __toString():string
    {
        // TODO: Implement __toString() method.
        return 'voiture '.$this->getId().' marque '.$this->getMarque();
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrixJour(): ?float
    {
        return $this->prix_jour;
    }

    public function setPrixJour(float $prix_jour): self
    {
        $this->prix_jour = $prix_jour;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, ImagesVoitures>
     */
    public function getImagesVoitures(): Collection
    {
        return $this->imagesVoitures;
    }

    public function addImagesVoiture(ImagesVoitures $imagesVoiture): self
    {
        if (!$this->imagesVoitures->contains($imagesVoiture)) {
            $this->imagesVoitures[] = $imagesVoiture;
            $imagesVoiture->setVoiture($this);
        }

        return $this;
    }

    public function removeImagesVoiture(ImagesVoitures $imagesVoiture): self
    {
        if ($this->imagesVoitures->removeElement($imagesVoiture)) {
            // set the owning side to null (unless already changed)
            if ($imagesVoiture->getVoiture() === $this) {
                $imagesVoiture->setVoiture(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPrix(): ?Prix
    {
        return $this->prix;
    }

    public function setPrix(?Prix $prix): self
    {
        // unset the owning side of the relation if necessary
        if ($prix === null && $this->prix !== null) {
            $this->prix->setVoiture(null);
        }

        // set the owning side of the relation if necessary
        if ($prix !== null && $prix->getVoiture() !== $this) {
            $prix->setVoiture($this);
        }

        $this->prix = $prix;

        return $this;
    }

    public function getPrixActuel(): ?float
    {
        return $this->prixActuel;
    }

    public function setPrixActuel(): self
    {
        $currentDate = new \DateTime();
        $currentYear = $currentDate->format("Y");
        $dS1 = $currentYear."-".$this->getPrix()->getDateDebutS1();
        $dS2 = $currentYear."-".$this->getPrix()->getDateDebutS2();
        $dS3 = $currentYear."-".$this->getPrix()->getDateDebutS3();
        $dS4 = $currentYear."-".$this->getPrix()->getDateDebutS4();
        $dateDS1 = \DateTime::createFromFormat('Y-m-d', $dS1);
        $dateDS2 = \DateTime::createFromFormat('Y-m-d', $dS2);
        $dateDS3 = \DateTime::createFromFormat('Y-m-d', $dS3);
        $dateDS4 = \DateTime::createFromFormat('Y-m-d', $dS4);
//            Todo: dates finales
        $dateFS1 = \DateTime::createFromFormat('Y-m-d', $dS2);
        $dateFS1->sub(new DateInterval('P1D'));
        $dateFS2 = \DateTime::createFromFormat('Y-m-d', $dS3);
        $dateFS2->sub(new DateInterval('P1D'));
        $dateFS3 = \DateTime::createFromFormat('Y-m-d', $dS4);
        $dateFS3->sub(new DateInterval('P1D'));
        $dateFS4 = \DateTime::createFromFormat('Y-m-d', $dS1);
        $dateFS4
//                ->add(new DateInterval('P1Y'))
            ->sub(new DateInterval('P1D'));
        if ($currentDate >= $dateDS1 && $currentDate <= $dateFS1){
            $this->prixActuel = $this->getPrix()->getPrixS1();
//            dd('true s1: ',$dS1, $this->getPrix()->getPrixS1(),$dateFS1);
        }
        else if ($currentDate >= $dateDS2 && $currentDate <= $dateFS2){
            $this->prixActuel = $this->getPrix()->getPrixS2();
//            dd('true s2: ',$dS2, $this->getPrix()->getPrixS2(),$dateFS2);
        }
        else if ($currentDate >= $dateDS3 && $currentDate <= $dateFS3){
            $this->prixActuel = $this->getPrix()->getPrixS3();
//            dd('true s3: ',$dS3, $this->getPrix()->getPrixS3(),$dateFS3);
        }
        else if ($currentDate >= $dateDS4 && $currentDate <= $dateFS4){
            $this->prixActuel = $this->getPrix()->getPrixS4();
//            dd('true s4: ',$dS4, $this->getPrix()->getPrixS4(),$dateFS4);
        }

        return $this;
    }


}
