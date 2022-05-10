<?php

namespace App\DataFixtures;

use App\Entity\Personne as EntityPersonne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Personne extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker= Factory::create();

        for ($i=0 ;$i<100 ; $i++ ){

            $personne= new EntityPersonne(); 
            $personne->setFirstname($faker->firstName); 
            $personne->setName($faker->name); 
            $personne->setAge($faker->numberBetween(18,54)); 
            $personne->setMood($faker->city);
            $manager->persist($personne);


        }
    

        $manager->flush();
    }
}
