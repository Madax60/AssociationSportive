<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 5; $i++) {
            $categ = new  Categorie();
            
            $categ
                ->setNom('Catégorie '.$i);
            
                $manager->persist($categ);
        }
        $manager->flush();
    }
}