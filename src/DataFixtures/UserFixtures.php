<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    const FIRSTNAME_DIPATCH = [
        "Olivier",
        "Sara",
        "Sophie",
        "Olivier"
    ];

    const LASTNAME_DISPATCH = [
        "Chatelin",
        "Ajana",
        "Wright",
        "Joubert"
    ];

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++) {
            $user = new User();
            $user->setEmail(strtolower(self::FIRSTNAME_DIPATCH[$i]) . '.' . strtolower(self::LASTNAME_DISPATCH[$i]) . '@gmail.com');
            $user->setFirstname(self::FIRSTNAME_DIPATCH[$i]);
            $user->setLastname(self::LASTNAME_DISPATCH[$i]);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($this->encoder->encodePassword($user,'123456'));
            $manager->persist($user);
            $this->addReference('user_' . ($i + 1),$user);
        }
        $manager->flush();

        $user = new User();
        $user->setEmail('contributor@gmail.com');
        $user->setFirstname('Cont');
        $user->setLastname('Ributor');
        $user->setRoles(['ROLE_CONTRIBUTOR']);
        $user->setPassword($this->encoder->encodePassword($user,'123456'));
        $manager->persist($user);
        $this->addReference('user_5',$user);
        $manager->flush();

        $user = new User();
        $user->setEmail('user@gmail.com');
        $user->setFirstname('Us');
        $user->setLastname('Er');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->encoder->encodePassword($user,'123456'));
        $manager->persist($user);
        $this->addReference('user_6',$user);
        $manager->flush();
    }
}
