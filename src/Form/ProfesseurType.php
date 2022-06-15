<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet')
            ->add(
                'grade',
                ChoiceType::class,
                [
                    'choices' =>
                    [
                        'Ingénieur' => 'Ingénieur',
                        'Docteur' => 'Docteur',
                        'Technicien' => 'Technicien'
                    ],
                    'multiple' => false
                ]
            )
            ->add(
                'modules',
                EntityType::class,
                [
                    'class' => Module::class,
                    'choice_label' => function ($modules) {
                        return $modules->getLibelleModule();
                    },
                    'multiple' => true
                ]
            )
            ->add('rp', HiddenType::class)
            ->add('classes');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
