<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MesEtudiants extends Fixture
{
    private Generator $faker;
    public function __construct ()
    {
        $this->faker = Factory::create('fr FR');
    }
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++)
        {
            $etudiant = new Etudiant();
            $etudiant   ->setNomComplet($this->faker->name)
                        ->setEmail($this->faker->email)
                        ->setPassword($this->faker->word)
                        ->setMatricule($this->faker->word.'ETU_2022')
                        ->setAdresse($this->faker->word)
                        ->setSexe(($i % 2 == 0 ? 'Masculin' : 'Féminin'));
            $manager->persist($etudiant);
        }
        $manager->flush();
    }
}
