<?php

namespace App\Form;

use App\Entity\Perso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PersoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('hp', IntegerType::class, [
                'label' => 'Points de vie (HP)',
                'disabled' => true, // Champ désactivé
                'attr' => ['class' => 'form-control'],
            ])            
            ->add('attaque')
            ->add('intelligence')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Perso::class,
        ]);
    }
}
