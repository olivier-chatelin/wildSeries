<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASON_DISPATCH = ['printemps','été','automne','hiver'];
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 4; $i++) {
            $season = new Season();
            $season->setNumber($i);
            $season->setDescription(self::SEASON_DISPATCH[$i - 1]);
            $season->setYear(2010 + $i);
            $season->setProgram($this->getReference('program_1'));

            $manager->persist($season);
            $this->addReference('season_' . $i,$season);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            ProgramFixtures::class
        ];
    }
}
