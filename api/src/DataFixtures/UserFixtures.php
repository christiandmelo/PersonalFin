<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername(username:'mestre')
             ->setPassword(password: '$2y$13$it0qnVRy//anJ9cw.uYEvuRQDLzHniJFDknZhRC93XZPZ47amFQzy');
        $manager->persist($user);

        $manager->flush();
    }
}
