<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\RP;
use App\Entity\Classe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LesClasses extends Fixture
{
    private Generator $faker;
    public function __construct ()
    {
        $this->faker = Factory::create('fr FR');
    }
    public function load(ObjectManager $manager): void
    {
        $niveaux=["L1","L2","L3"];
        $filieres=["MAI","ANG","INFO"];
        for ($i = 1; $i <=10; $i++)
        {
            $rp = new RP ();
            $rp->setNomComplet($this->faker->name)
            ->setEmail($this->faker->email)
            ->setPassword($this->faker->word);
            $manager->persist($rp);
            $pos= rand(0,2);
            $classe = new Classe();
            $classe->setLibelle($niveaux[$pos]."_".$filieres[$pos]);
            $this->addReference("Classe".$i, $classe);
            $classe->setRp($rp);
            $manager->persist($classe);
        }
        $manager->flush();
    }
}
