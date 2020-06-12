<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
            $user = new User();
            $user->setRoles(['ROLE_SUBSCRIBERS']);
            $user->setEmail($faker->email);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'the_new_password'
            ));
            $manager->persist($user);

            $admin = new User();
            $admin->setEmail('admin@monsite.com');
            $admin->setRoles(['ROLE_ADMIN']);
            $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
            ));
            $manager->persist($admin);

            $manager->flush();
    }
}
