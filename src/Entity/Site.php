<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SiteRepository::class)]
class Site
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, Responsite>
     */
    #[ORM\OneToMany(targetEntity: Responsite::class, mappedBy: 'site')]
    private Collection $responsites;

    public function __construct()
    {
        $this->responsites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Responsite>
     */
    public function getResponsites(): Collection
    {
        return $this->responsites;
    }

    public function addResponsite(Responsite $responsite): static
    {
        if (!$this->responsites->contains($responsite)) {
            $this->responsites->add($responsite);
            $responsite->setSite($this);
        }

        return $this;
    }

    public function removeResponsite(Responsite $responsite): static
    {
        if ($this->responsites->removeElement($responsite)) {
            // set the owning side to null (unless already changed)
            if ($responsite->getSite() === $this) {
                $responsite->setSite(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
