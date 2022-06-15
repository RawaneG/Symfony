<?php

namespace App\Form;

use App\Entity\Inscription;
use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'etudiant',
                EtudiantType::class,
                ['label' => false]
            )
            ->add(
                'classe',
                EntityType::class,
                [
                    'class' => Classe::class,
                    'choice_label' => function ($classe) {
                        return $classe->getLibelle();
                    },
                    'multiple' => false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
