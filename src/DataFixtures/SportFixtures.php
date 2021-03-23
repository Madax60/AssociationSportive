<?php

namespace App\DataFixtures;

use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SportFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 5; $i++) {
            $sport = new  Sport();
            
            $sport
                ->setNom('Sport '.$i);
            
                $manager->persist($sport);
        }
        $manager->flush();
    }
}