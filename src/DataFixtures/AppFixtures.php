<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Choix;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 25000; $i++) { 
            $choix = new Choix();
            $choix->setNom($faker->name);

            $manager->persist($choix);
        }

        $manager->flush();
    }
}
