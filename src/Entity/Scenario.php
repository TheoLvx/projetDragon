<?php

namespace App\Entity;

use App\Repository\ScenarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScenarioRepository::class)]
class Scenario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $contexte = null;

    #[ORM\Column]
    private ?int $niveau = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    /**
     * @var Collection<int, Choix>
     */
    #[ORM\OneToMany(targetEntity: Choix::class, mappedBy: 'LeScenario')]
    private Collection $LesChoix;

    public function __construct()
    {
        $this->LesChoix = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getContexte(): ?string
    {
        return $this->contexte;
    }

    public function setContexte(string $contexte): static
    {
        $this->contexte = $contexte;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Choix>
     */
    public function getLesChoix(): Collection
    {
        return $this->LesChoix;
    }

    public function addLesChoix(Choix $lesChoix): static
    {
        if (!$this->LesChoix->contains($lesChoix)) {
            $this->LesChoix->add($lesChoix);
            $lesChoix->setLeScenario($this);
        }

        return $this;
    }

    public function removeLesChoix(Choix $lesChoix): static
    {
        if ($this->LesChoix->removeElement($lesChoix)) {
            // set the owning side to null (unless already changed)
            if ($lesChoix->getLeScenario() === $this) {
                $lesChoix->setLeScenario(null);
            }
        }

        return $this;
    }

    public function setLesChoix(array $lesChoix): self

    {

        $this->lesChoix = $lesChoix;



        return $this;

    }


}
