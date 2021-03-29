<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $classe = new  Classe();
            
            $classe
                ->setNom('Classe '.$i);
            
                $manager->persist($classe);
        }
        $manager->flush();
    }
}