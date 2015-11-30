<?php

namespace Ais\BimbinganBundle\Tests\Fixtures\Entity;

use Ais\BimbinganBundle\Entity\Bimbingan;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadBimbinganData implements FixtureInterface
{
    static public $bimbingans = array();

    public function load(ObjectManager $manager)
    {
        $bimbingan = new Bimbingan();
        $bimbingan->setTitle('title');
        $bimbingan->setBody('body');

        $manager->persist($bimbingan);
        $manager->flush();

        self::$bimbingans[] = $bimbingan;
    }
}
