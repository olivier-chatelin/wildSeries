<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASON_DISPATCH = ['season_1','season_1','season_2','season_2','season_3'];
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $episode = new Episode();
            $episode->setTitle('épisode ' . $i);
            $episode->setNumber($i);
            $episode->setSynopsis('Synopsis de l\'épisode ' . $i . ': Je m\'en vais sur la route en chantant gaiement, quand il tombe des gouttes et qu\'il fait mauvais temps, moi je chante quand même parce que je suis content');
            $episode->setSeason($this->getReference(self::SEASON_DISPATCH[$i - 1]));
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
