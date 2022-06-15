<?php

namespace App\Form;

use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'filiere',
                ChoiceType::class,
                [
                    'mapped' => false,
                    'choices' =>
                    [
                        'Mathématiques' => 'Mathématiques',
                        'Anglais' => 'Anglais',
                        'Informatique' => 'Informatique'
                    ],
                    'multiple' => false
                ]
            )
            // ->add('rp', HiddenType::class)
            ->add(
                'niveau',
                ChoiceType::class,
                [
                    'mapped' => false,
                    'choices' =>
                    [
                        'Licence 1' => 'L1',
                        'Licence 2' => 'L2',
                        'Licence 3' => 'L3',
                        'Master 1' => 'M1',
                        'Master 2' => 'M2',
                        'Doctorat' => 'D'
                    ],
                    'multiple' => false
                ]
            );
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
