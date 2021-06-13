<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Episode;
use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAM_DISPATCH = ['Maggy','Supercopter','Sauvés par le Gong','Parker Lewis ne perd jamais'];
    public const COUNTRY_DISPATCH = ['France','USA','USA','USA'];
    public const CATEGORY_DISPATCH = ['category_5','category_0','category_5','category_5'];
    private  $slug;

    public function __construct(Slugify $slug)
    {
        $this->slug = $slug;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4 ; $i++) {
            $program = new Program();
            $program->setTitle(self::PROGRAM_DISPATCH[$i]);
            $program->setSummary('Ceci est la description du programme ' . ($i+1));
            $program->setCountry(self::COUNTRY_DISPATCH[$i]);
            $program->setYear(2000 + $i);
            $program->setCategory($this->getReference(self::CATEGORY_DISPATCH[$i]));
            $program->setSlug($this->slug->generate($program->getTitle()));
            $program->setUpdatedAt(new \DateTime('now'));
            $program->setPoster('fix' . ($i+1) . '.jpeg');
            $program->setOwner($this->getReference('user_' . ($i+2)));
            $manager->persist($program);
            $this->addReference('program_' . ($i + 1)  , $program);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
            UserFixtures::class
        ];
    }
}
