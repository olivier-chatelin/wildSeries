<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setPassword($this->encoder->encodePassword($user,'1234'));
        $user->setEmail('olivier.chatelin@gmail.com');
        $user->setRoles(['ROLE_CONTRIBUTOR']);
        $manager->persist($user);

        $manager->flush();

        $admin = new User();
        $admin->setPassword($this->encoder->encodePassword($admin,('1234')));
        $admin->setEmail('olivierchatelin@outlook.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->flush();
    }

}
