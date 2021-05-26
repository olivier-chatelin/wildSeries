<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setName('Action');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Aventure');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Animation');
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName('Fantastique');
        $manager->persist($category4);

        $category5 = new Category();
        $category5->setName('Aventure');
        $manager->persist($category5);

        $category6 = new Category();
        $category6->setName('Horreur');
        $manager->persist($category6);



        $e1s1Wd = new Episode();
        $e1s1Wd->setNumber(1)
            ->setSynopsis("La population entière a été ravagée par une épidémie d'origine inconnue, qui est envahie par les morts-vivants. Parti sur les traces de sa femme Lori et de son fils Carl, Rick arrive à Atlanta où, avec un groupe de rescapés, il va devoir apprendre à survivre et à tuer tout en cherchant une solution ou un remède. ")
            ->setTitle('Passé décomposé');
        $manager->persist($e1s1Wd);

        $e2s1Wd = new Episode();
        $e2s1Wd->setNumber(2)
            ->setSynopsis("Rick parvient à s'échapper du tank grâce à l'aide de Glenn, dont il avait entendu la voix à la radio. Rick et Glenn se réunissent avec les compagnons de Glenn, un autre groupe de survivants dont Andrea, T-dog, Merle, Morales, Jacqui, venus pour se ravitailler au supermarché. Cependant, l'arrivée mouvementée de Rick les met tous en péril, l'attention des zombies ayant été attirée sur leur cachette. Assiégé par les zombies, le groupe parvient brièvement à communiquer par radio avec le groupe de Shane et Lori, mais ceux-ci décident qu'ils ne peuvent les aider, la présence de Rick ne leur ayant pas encore été communiquée. ")
            ->setTitle("Tripes");
        $manager->persist($e2s1Wd);

        $e3s1Wd = new Episode();
        $e3s1Wd->setNumber(3)
            ->setSynopsis("De retour au camp avec le groupe de survivants du supermarché, Rick retrouve enfin et avec beaucoup d'émotion sa femme Lori et son fils Carl.")
            ->setTitle(" T’as qu’à discuter avec les grenouilles");
        $manager->persist($e3s1Wd);

        $e4s1Wd = new Episode();
        $e4s1Wd->setNumber(4)
            ->setSynopsis("En cherchant Merle, le groupe essaie aussi, par la même occasion, de retrouver le sac d'armes mais un autre groupe de survivants, également en quête des armes, les attaque. ")
            ->setTitle("Le Gang");
        $manager->persist($e4s1Wd);

        $e1s2Wd = new Episode();
        $e1s2Wd->setNumber(1)
            ->setSynopsis("Après l'explosion du CDC, les survivants reprennent la route et se dirigent vers Fort Benning. ")
            ->setTitle("Ce qui nous attend");
        $manager->persist($e1s2Wd);

        $e2s2Wd = new Episode();
        $e2s2Wd->setNumber(2)
            ->setSynopsis("Après que Carl s'est fait tirer dessus par un chasseur, Rick trouve de l'aide chez Hershel Greene, un vétérinaire vivant dans une ferme non loin de l'autoroute.")
            ->setTitle("Saignée");
        $manager->persist($e2s2Wd);

        $e3s2Wd = new Episode();
        $e3s2Wd->setNumber(3)
            ->setSynopsis("À court de munitions, Shane décide de tirer sur Otis pour faire diversion et lui permettre de s'enfuir avec le matériel. ")
            ->setTitle("Le Tout pour le tout");
        $manager->persist($e3s2Wd);

        $e4s2Wd = new Episode();
        $e4s2Wd->setNumber(4)
            ->setSynopsis("Les funérailles d'Otis ont lieu, bien que son corps ne soit pas présent. Daryl décide de continuer à chercher Sophia, et entre dans une maison abandonnée où il trouve des restes de nourriture récemment consommée.")
            ->setTitle("Rose Cherokee");
        $manager->persist($e4s2Wd);

        $e1s4Wd = new Episode();
        $e1s4Wd->setNumber(1)
            ->setSynopsis("Les funérailles d'Otis ont lieu, bien que son corps ne soit pas présent. Daryl décide de continuer à chercher Sophia, et entre dans une maison abandonnée où il trouve des restes de nourriture récemment consommée. ")
            ->setTitle("Le Chupacabra");
        $manager->persist($e1s4Wd);

        $e2s4Wd = new Episode();
        $e2s4Wd->setNumber(2)
            ->setSynopsis("Glenn doit garder le secret pour les rôdeurs dans la grange, mais également sur le fait que Lori est enceinte. Il dévoile finalement ces deux secrets à Dale.")
            ->setTitle("Secrets");
        $manager->persist($e2s4Wd);

        $e3s4Wd = new Episode();
        $e3s4Wd->setNumber(3)
            ->setSynopsis("Glenn avoue au reste du groupe que la grange est remplie de rôdeurs. ")
            ->setTitle("Déjà plus ou moins mort");
        $manager->persist($e3s4Wd);

        $e4s4Wd = new Episode();
        $e4s4Wd->setNumber(4)
            ->setSynopsis("Après que les rôdeurs de la grange ont été éliminés et que Sophia fut abattue par Rick, Hershel se rend seul en ville. ")
            ->setTitle("Nebraska");
        $manager->persist($e4s4Wd);





        $s1Wd = new Season();
        $s1Wd->setNumber(1)
            ->setYear(2010)
            ->setDescription("Après une épidémie post-apocalyptique ayant transformé la quasi-totalité de la population américaine et mondiale en mort-vivants ou « rôdeurs », un groupe d'hommes et de femmes mené par l'adjoint du shérif du comté de Kings (en Géorgie) USA, Rick Grimes, tente de survivre…Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde devenu méconnaissable, à travers leur périple dans le Sud profond des États-Unis. ")
            ->addEpisode($e1s1Wd)
            ->addEpisode($e2s1Wd)
            ->addEpisode($e3s1Wd)
            ->addEpisode($e4s1Wd);

        $manager->persist($s1Wd);

        $s2Wd = new Season();
        $s2Wd->setNumber(2)
            ->setYear(2012)
            ->setDescription("À la suite de l'explosion du CDC, le groupe de survivants mené par Rick Grimes arrive à la ferme des Greene pour survivre aux rôdeurs.  ")
            ->addEpisode($e1s2Wd)
            ->addEpisode($e2s2Wd)
            ->addEpisode($e3s2Wd)
            ->addEpisode($e4s2Wd);

        $manager->persist($s2Wd);

        $s3Wd = new Season();
        $s3Wd->setNumber(3)
            ->setYear(2014)
            ->setDescription("Après avoir été contraint de quitter en hâte la ferme de Hershel sous l'assaut des rôdeurs, le petit groupe erre péniblement dans un monde de plus en plus chaotique et dangereux, tandis que la grossesse de Lori arrive bientôt à son terme.   ")
            ->addEpisode($e1s4Wd)
            ->addEpisode($e2s4Wd)
            ->addEpisode($e3s4Wd)
            ->addEpisode($e4s4Wd);

        $manager->persist($s3Wd);

        $program1 = new Program();
        $program1->setTitle('Walking Dead')
            ->setSummary('Le policier Rick Grimes se réveille après un long coma. Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.')
            ->setPoster("https://m.media-amazon.com/images/M/MV5BZmFlMTA0MmUtNWVmOC00ZmE1LWFmMDYtZTJhYjJhNGVjYTU5XkEyXkFqcGdeQXVyMTAzMDM4MjM0._V1_.jpg")
            ->setCategory($category6)
            ->setYear(2010)
            ->setCountry('USA')
            ->addSeason($s1Wd)
            ->addSeason($s2Wd)
            ->addSeason($s3Wd);
        $manager->persist($program1);


        $manager->flush();

    }
}
