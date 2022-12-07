<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Choix;
use App\Entity\Personne;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 5000; $i++) { 
            $choix = new Choix();
            $choix->setNom($faker->name);

            $manager->persist($choix);
        }

        for ($i=0; $i < 5000; $i++) { 
            $personne = new Personne();
            $personne->setNom($faker->lastname);
            $personne->setPrenom($faker->firstname);


            $manager->persist($personne);
        }

        $manager->flush();
    }
}
