<?php

namespace App\DataFixtures;
use App\Entity\AnneeScolaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LesAnneesScolaires extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=2019; $i <2022 ; $i++)
        {
            $data=new AnneeScolaire();
            $annee= $i."-".($i+1);
            $data->setLibelleAnnee($annee)
            ->setEtat(false);
            $manager->persist($data);
            $this->addReference("AnneeScolaire".$i, $data);
        }
        $manager->flush();
    }
}
