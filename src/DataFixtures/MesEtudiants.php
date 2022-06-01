<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MesEtudiants extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $etudiant = new Etudiant();
        $etudiant   ->setNomComplet('Rawane Meissa Sow')
                    ->setRoles(['ROLE_ETUDIANT'])
                    ->setEmail('rawaneG.meissa@gmail.com')
                    ->setPassword('rawane')
                    ->setMatricule('ETU_2022')
                    ->setAdresse('Sacré Coeur')
                    ->setSexe('Masculin');
        $manager->persist($etudiant);
        $manager->flush();
    }
}
