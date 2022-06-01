<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LesModules extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <=10; $i++)
        {
            $module = new Module();
            $module->setLibelleModule('Module '.$i);
            $manager->persist($module);
            $this->addReference("Module".$i, $module);
        }
            $manager->flush();
    }
}
