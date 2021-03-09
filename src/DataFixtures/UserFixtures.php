<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $roles = [
            User::ROLE_USER,
            User::ROLE_ADMIN,
        ];

        for ($i = 1; $i < 10; $i++) {
            $user = new User();
            $password = '123';

            $user
                ->setEmail('user-'.$i.'@gmail.com')
                ->setRoles([$roles[rand(0,1)]]);

            // Encode le mot de passe et l'insère dans le champ "password".
            $user->setPassword($this->encoder->encodePassword($user, $password));
            $manager->persist($user);
            $this->addReference('user-'.$i, $user);
        }

        $manager->flush();
    }
}
