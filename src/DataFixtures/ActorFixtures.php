<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;



class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public const ACTORS = [
        'Andrew Lincoln',
        'Norman Reedus',
        'Lauren Cohan',
        'Danai Gurira',
        'Bryan Cranston',
        'Aaron Paul',
        'Olivier Châtelin',
        'Olivier Joubert',
        'Marthe Villalonga',
        'Rosy Varthe',
        'Jean-Marc Thibault'

    ];
    public const PROGAM_DIPATCH = ['program_2','program_2','program_2','program_2','program_3','program_3','program_3','program_4','program_4','program_4','program_4'];
    private Slugify $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        foreach (self::ACTORS as $key => $actorName){
            $actor = new Actor();
            $actor->setName($actorName);
            $slug = $this->slugify->generate($actor->getName());
            $actor->setSlug($slug);
            $actor->setPoster('actFix'. ($key + 1) . '.jpeg');
            $actor->addProgram($this->getReference(self::PROGAM_DIPATCH[$key]));
            $manager->persist($actor);
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
