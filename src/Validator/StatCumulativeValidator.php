<?php
namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Entity\Perso;

class StatCumulativeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var StatCumulative $constraint */

        // Vérifiez que l'objet est une instance de Perso
        if (!$value instanceof Perso) {
            return;
        }

        // Calcul de la somme des statistiques
        $sum = $value->getHp() + $value->getAttaque() + $value->getIntelligence();

        // Vérification si la somme dépasse la limite
        if ($sum > $constraint->limit) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ limit }}', $constraint->limit)
                ->addViolation();
        }
    }
}
