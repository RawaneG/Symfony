<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantType extends AbstractType
{
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $etudiant = new Etudiant();
        $mdp = $this->hasher->hashPassword($etudiant, 'passer123');
        $builder
            ->add('nomComplet')
            ->add('email')
            ->add('adresse')
            ->add(
                'password',
                HiddenType::class,
                [
                    'attr' => [
                        'value' => $mdp
                    ]
                ]
            )
            ->add(
                'sexe',
                ChoiceType::class,
                [
                    'choices' =>
                    [
                        'Veuillez choisir le sexe' => null,
                        'Masculin' => 'Masculin',
                        'Féminin' => 'Feminin'
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
