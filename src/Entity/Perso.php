<?php

namespace App\Entity;

use App\Validator\StatCumulative;
use App\Repository\PersoRepository;
use Symfony\Component\Validator\Constraints as Assert; // Import correct des contraintes Symfony
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersoRepository::class)]
#[StatCumulative(limit: 5)] // Appliquer la contrainte au niveau de la classe
class Perso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column]
    private int $hp = 10; // Initialisation par défaut à 10

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual(value: 0, message: 'L\'attaque ne peut pas être négative.')]
    private ?int $attaque = null;

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual(value: 0, message: 'L\'intelligence ne peut pas être négative.')]
    private ?int $intelligence = null;


    // Getters et setters...


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): static
    {
        $this->hp = $hp;

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

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): static
    {
        $this->intelligence = $intelligence;

        return $this;
    }
}
