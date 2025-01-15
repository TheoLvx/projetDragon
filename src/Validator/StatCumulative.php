<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_CLASS)]
class StatCumulative extends Constraint
{
    public string $message = 'La somme des statistiques (HP, Attaque, Intelligence) ne doit pas dépasser {{ limit }}.';
    public int $limit = 5;

    // Indique que la contrainte s'applique à une classe entière
    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
