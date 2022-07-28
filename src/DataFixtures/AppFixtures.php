<?php

namespace App\DataFixtures;

use App\Entity\Societe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');


        for ($i=0; $i < 10000; $i++) { 
            $choix = new Societe();
            $choix->setNom($faker->name);

            $manager->persist($choix);
        }

        $manager->flush();
    }
}
        // $manager->persist($product);

