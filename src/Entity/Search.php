<?php

namespace App\Entity;

use App\Repository\SearchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SearchRepository::class)]
class Search
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'search', targetEntity: Personne::class)]
    private Collection $personne;

    public function __construct()
    {
        $this->personne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getPersonne(): Collection
    {
        return $this->personne;
    }

    public function addPersonne(Personne $personne): self
    {
        if (!$this->personne->contains($personne)) {
            $this->personne->add($personne);
            $personne->setSearch($this);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): self
    {
        if ($this->personne->removeElement($personne)) {
            // set the owning side to null (unless already changed)
            if ($personne->getSearch() === $this) {
                $personne->setSearch(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return 'recherche';
    }
}
