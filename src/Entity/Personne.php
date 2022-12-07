<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'personne', targetEntity: Simple::class)]
    private Collection $simples;

    #[ORM\ManyToMany(targetEntity: Multiple::class, mappedBy: 'personne')]
    private Collection $multiples;

    #[ORM\ManyToOne(inversedBy: 'personne')]
    private ?Search $search = null;

    public function __construct()
    {
        $this->simples = new ArrayCollection();
        $this->multiples = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Simple>
     */
    public function getSimples(): Collection
    {
        return $this->simples;
    }

    public function addSimple(Simple $simple): self
    {
        if (!$this->simples->contains($simple)) {
            $this->simples->add($simple);
            $simple->setPersonne($this);
        }

        return $this;
    }

    public function removeSimple(Simple $simple): self
    {
        if ($this->simples->removeElement($simple)) {
            // set the owning side to null (unless already changed)
            if ($simple->getPersonne() === $this) {
                $simple->setPersonne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Multiple>
     */
    public function getMultiples(): Collection
    {
        return $this->multiples;
    }

    public function addMultiple(Multiple $multiple): self
    {
        if (!$this->multiples->contains($multiple)) {
            $this->multiples->add($multiple);
            $multiple->addPersonne($this);
        }

        return $this;
    }

    public function removeMultiple(Multiple $multiple): self
    {
        if ($this->multiples->removeElement($multiple)) {
            $multiple->removePersonne($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->prenom . " " . $this->nom;
    }

    public function getSearch(): ?Search
    {
        return $this->search;
    }

    public function setSearch(?Search $search): self
    {
        $this->search = $search;

        return $this;
    }
}
