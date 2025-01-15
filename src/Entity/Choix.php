<?php

namespace App\Entity;

use App\Repository\ChoixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChoixRepository::class)]
class Choix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $texte = null;

    #[ORM\Column(length: 255)]
    private ?string $hp = null;

    #[ORM\Column(length: 255)]
    private ?string $explications = null;

    #[ORM\Column]
    private ?int $intelligence = null;

    #[ORM\Column]
    private ?int $attaque = null;

    #[ORM\ManyToOne(inversedBy: 'LesChoix')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Scenario $LeScenario = null;

 

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): static
    {
        $this->texte = $texte;

        return $this;
    }

    public function getHp(): ?string
    {
        return $this->hp;
    }

    public function setHp(string $hp): static
    {
        $this->hp = $hp;

        return $this;
    }

    public function getExplications(): ?string
    {
        return $this->explications;
    }

    public function setExplications(string $explications): static
    {
        $this->explications = $explications;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): static
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getAttaque(): ?int
    {
        return $this->attaque;
    }

    public function setAttaque(int $attaque): static
    {
        $this->attaque = $attaque;

        return $this;
    }

    public function getLeScenario(): ?Scenario
    {
        return $this->LeScenario;
    }

    public function setLeScenario(?Scenario $LeScenario): static
    {
        $this->LeScenario = $LeScenario;

        return $this;
    }
}
