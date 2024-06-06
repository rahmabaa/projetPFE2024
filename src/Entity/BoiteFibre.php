<?php

namespace App\Entity;

use App\Repository\BoiteFibreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoiteFibreRepository::class)]
class BoiteFibre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Alerte::class, mappedBy: 'boite')]
    private Collection $nomdeboite;
    public function __toString(){
    
        return $this->getNom();
    }
    public function __construct()
    {
        $this->nomdeboite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Alerte>
     */
    public function getNomdeboite(): Collection
    {
        return $this->nomdeboite;
    }

    public function addNomdeboite(Alerte $nomdeboite): static
    {
        if (!$this->nomdeboite->contains($nomdeboite)) {
            $this->nomdeboite->add($nomdeboite);
            $nomdeboite->addBoite($this);
        }

        return $this;
    }

    public function removeNomdeboite(Alerte $nomdeboite): static
    {
        if ($this->nomdeboite->removeElement($nomdeboite)) {
            $nomdeboite->removeBoite($this);
        }

        return $this;
    }
}
