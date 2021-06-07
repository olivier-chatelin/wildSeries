<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Episode;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAM_DISPATCH = ['Maggy','Supercopter','Sauvés par le Gong','Parker Lewis ne perd jamais'];
    public const COUNTRY_DISPATCH = ['France','USA','USA','USA'];
    public const CATEGORY_DISPATCH = ['category_5','category_0','category_5','category_5'];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4 ; $i++) {
            $program = new Program();
            $program->setTitle(self::PROGRAM_DISPATCH[$i]);
            $program->setSummary('Ceci est la description du programme ' . ($i+1));
            $program->setPoster('https://picsum.photos/200/300');
            $program->setCountry(self::COUNTRY_DISPATCH[$i]);
            $program->setYear(2000 + $i);
            $program->setCategory($this->getReference(self::CATEGORY_DISPATCH[$i]));
            $manager->persist($program);
            $this->addReference('program_' . ($i + 1)  , $program);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [
          CategoryFixtures::class
        ];
    }
}
