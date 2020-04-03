<?php

namespace App\DataFixtures;

use App\Entity\System;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SystemFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $system = new System();
        $system
            ->setSeed(100500)
            ->setSize(System::SIZE_MEDIUM)
            ->setName("USC-100N-500E")
            ->setPublicName("Solar System")
            ->setX(100)
            ->setY(500);

        $manager->persist($system);
        $manager->flush();
    }
}
