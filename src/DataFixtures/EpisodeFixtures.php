<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Service\Slugify;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private $slugify;
    public const SEASON_DISPATCH = ['season_1','season_1','season_2','season_2','season_3'];

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $episode = new Episode();
            $episode->setTitle('épisode ' . $i);
            $episode->setNumber($i);
            $episode->setSynopsis('Synopsis de l\'épisode ' . $i . ': Je m\'en vais sur la route en chantant gaiement, quand il tombe des gouttes et qu\'il fait mauvais temps, moi je chante quand même parce que je suis content');
            $episode->setSeason($this->getReference(self::SEASON_DISPATCH[$i - 1]));
            $episode->setSlug($this->slugify->generate($episode->getTitle()));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
            ProgramFixtures::class,
        ];
    }
}
