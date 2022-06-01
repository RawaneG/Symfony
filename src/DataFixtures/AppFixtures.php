<?php

namespace App\DataFixtures;
use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $etudiant = new Etudiant();
        $etudiant   ->setNomComplet('Rawane Meissa Sow')
                    ->setRole('ROLE_ETUDIANT')
                    ->setLogin('rawane.meissa@gmail.com')
                    ->setMdp('rawane10')
                    ->setMatricule('ETU_2022')
                    ->setAdresse('Sacré Coeur')
                    ->setSexe('Masculin');
        $manager->persist($etudiant);
        $manager->flush();
    }
}
