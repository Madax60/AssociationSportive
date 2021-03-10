<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SportFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $sport = new  Type();
            
            $sport
                ->setNom('Type '.$i);
            
                $manager->persist($sport);
        }
        $manager->flush();
    }
}