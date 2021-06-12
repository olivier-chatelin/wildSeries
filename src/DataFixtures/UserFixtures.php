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
        }
        $manager->flush();
    }
}
