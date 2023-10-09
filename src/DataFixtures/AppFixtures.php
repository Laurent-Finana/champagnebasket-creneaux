<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $users = [];
        for ($u = 0; $u < 10; $u++) {
            $user = new User();
            $user
                ->setEmail($faker->email)
                ->setPassword($faker->password)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPhoneNumber($faker->phoneNumber);
            $manager->persist($user);

            $users[] = $user;
        }

        $manager->flush();
    }
}
