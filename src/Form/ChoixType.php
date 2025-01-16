<?php

namespace App\Form;

use App\Entity\Choix;
use App\Entity\Scenario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('texte')
            ->add('hp')
            ->add('explications')
            ->add('intelligence')
            ->add('attaque')
            ->add('LeScenario', EntityType::class, [
                'class' => Scenario::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Choix::class,
        ]);
    }
}
