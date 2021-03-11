<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Entity\Sport;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EvenementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 2; $i++) {
            $event = new  Evenement();
            
            $event
                ->setNom('Evenement '.$i)
                ->setDescription('Evenement '.$i)
                ->setDateDebut(new \DateTime('now'))
                ->setNombrePlaces('5')
                ->setImage('5')
                ->setVignette('5')
                ->setDuree('5')
                ->setDateFin(new \DateTime('06/05/2025'))
                ->setCategorie(new Categorie)
                ->setType(new Type)
                ->setSport(new Sport);
        }
        $manager->flush();
    }
}