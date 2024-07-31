<?php

namespace App\DataFixtures;

use App\Factory\MultiStoreFactory;
use App\Factory\StoreFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(
            5,
            fn (int $i) =>
            [
                'email' => "user$i@gmail.com",
                'username' => "user$i"
            ]
        );

        MultiStoreFactory::createMany(
            5,
            fn () => ['owner' => UserFactory::random()]
        );

        UserFactory::new()->admin()->create();

        StoreFactory::createMany(
            5,
            fn () => ['multiStore' => MultiStoreFactory::random()]
        );
    }
}
