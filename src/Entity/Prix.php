<?php

namespace App\Entity;

use App\Repository\PrixRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PrixRepository::class)
 */
class Prix
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Regex(
     *     pattern = "/(([0][0-9])|([1][0-2]))-(([0-2][0-9])|([3][0|1]))/",
     *     message="date doit être de la forme mm-jj"
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=10)
     */
    private $DateDebutS1;

//    /**
//     * @ORM\Column(type="date")
//     */
//    private $DateFinS1;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float")
     */
    private $PrixS1;

    /**
     * @Assert\Regex(
     *     pattern = "/(([0][0-9])|([1][0-2]))-(([0-2][0-9])|([3][0|1]))/",
     *     message="date doit être de la forme mm-jj"
     * )
     * @ORM\Column(type="string", length=10)
     */
    private $DateDebutS2;

//    /**
//     * @ORM\Column(type="date")
//     */
//    private $DateFinS2;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float")
     */
    private $PrixS2;

    /**
     * @Assert\Regex(
     *     pattern = "/(([0][0-9])|([1][0-2]))-(([0-2][0-9])|([3][0|1]))/",
     *     message="date doit être de la forme mm-jj"
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=10)
     */
    private $DateDebutS3;

//    /**
//     * @ORM\Column(type="date")
//     */
//    private $DateFinS3;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float")
     */
    private $PrixS3;

    /**
     * @Assert\Regex(
     *     pattern = "/(([0][0-9])|([1][0-2]))-(([0-2][0-9])|([3][0|1]))/",
     *     message="date doit être de la forme mm-jj"
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=10)
     */
    private $DateDebutS4;

//    /**
//     * @ORM\Column(type="date")
//     */
//    private $DateFinS4;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float")
     */
    private $PrixS4;

    /**
     * @ORM\OneToOne(targetEntity=Voiture::class, inversedBy="prix", cascade={"persist", "remove"})
     */
    private $voiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebutS1(): ?string
    {
        return $this->DateDebutS1;
    }

    public function setDateDebutS1(string $DateDebutS1): self
    {
        $this->DateDebutS1 = $DateDebutS1;

        return $this;
    }

//    public function getDateFinS1(): ?\DateTimeInterface
//    {
//        return $this->DateFinS1;
//    }

//    public function setDateFinS1(\DateTimeInterface $DateFinS1): self
//    {
//        $this->DateFinS1 = $DateFinS1;
//
//        return $this;
//    }

    public function getPrixS1(): ?float
    {
        return $this->PrixS1;
    }

    public function setPrixS1(float $PrixS1): self
    {
        $this->PrixS1 = $PrixS1;

        return $this;
    }

    public function getDateDebutS2(): ?string
    {
        return $this->DateDebutS2;
    }

    public function setDateDebutS2(string $DateDebutS2): self
    {
        $this->DateDebutS2 = $DateDebutS2;

        return $this;
    }

//    public function getDateFinS2(): ?\DateTimeInterface
//    {
//        return $this->DateFinS2;
//    }
//
//    public function setDateFinS2(\DateTimeInterface $DateFinS2): self
//    {
//        $this->DateFinS2 = $DateFinS2;
//
//        return $this;
//    }

    public function getPrixS2(): ?float
    {
        return $this->PrixS2;
    }

    public function setPrixS2(float $PrixS2): self
    {
        $this->PrixS2 = $PrixS2;

        return $this;
    }

    public function getDateDebutS3(): ?string
    {
        return $this->DateDebutS3;
    }

    public function setDateDebutS3(string $DateDebutS3): self
    {
        $this->DateDebutS3 = $DateDebutS3;

        return $this;
    }

//    public function getDateFinS3(): ?\DateTimeInterface
//    {
//        return $this->DateFinS3;
//    }
//
//    public function setDateFinS3(\DateTimeInterface $DateFinS3): self
//    {
//        $this->DateFinS3 = $DateFinS3;
//
//        return $this;
//    }

    public function getPrixS3(): ?float
    {
        return $this->PrixS3;
    }

    public function setPrixS3(float $PrixS3): self
    {
        $this->PrixS3 = $PrixS3;

        return $this;
    }

    public function getDateDebutS4(): ?string
    {
        return $this->DateDebutS4;
    }

    public function setDateDebutS4(string $DateDebutS4): self
    {
        $this->DateDebutS4 = $DateDebutS4;

        return $this;
    }

//    public function getDateFinS4(): ?\DateTimeInterface
//    {
//        return $this->DateFinS4;
//    }
//
//    public function setDateFinS4(\DateTimeInterface $DateFinS4): self
//    {
//        $this->DateFinS4 = $DateFinS4;
//
//        return $this;
//    }

    public function getPrixS4(): ?float
    {
        return $this->PrixS4;
    }

    public function setPrixS4(float $PrixS4): self
    {
        $this->PrixS4 = $PrixS4;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }
}
