<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_CLASS)]
class StatCumulative extends Constraint
{
    public string $message = 'La somme des statistiques  Attaque, Intelligence) ne doit pas dépasser {{ limit }}.';
    public int $limit;

    public function __construct(int $limit = 5, string $message = null, array $groups = null, mixed $payload = null)
    {
        parent::__construct(groups: $groups, payload: $payload);

        $this->limit = $limit;

        if ($message !== null) {
            $this->message = $message;
        }
    }

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
