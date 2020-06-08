<?php


namespace App\DataFixtures;
use Faker;
use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Norman Reedus',
        'Andrew Lincoln',
        'Lauren Cohan',
        'Jeffrey Dean Morgan',
        'Chandler Riggs',
        'Danai Gurira',
        'RChristian Serratos',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $key => $ACTORNAME) {
            $actor = new Actor();
            $actor -> setName($ACTORNAME);
            $this->addReference('actor_' . $key, $actor);
            $actor ->addProgram($this->getReference('program_0'));

            $manager->persist($actor);
        }
        $manager->flush();

        for($i = 1; $i <= 47; $i++) {
            $actor = new Actor();
            $faker = Faker\Factory::create('fr_FR');
            $actor->setName($faker->name);
            $actor ->addProgram($this->getReference('program_0'));

            $manager->persist($actor);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

}