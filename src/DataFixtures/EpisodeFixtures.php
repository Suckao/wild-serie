<?php


namespace App\DataFixtures;

use App\DataFixtures\SeasonFixtures;
use App\Entity\Episode;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i<50; $i++){
            $episode = new Episode();
            $faker = Faker\Factory::create('fr_FR');
            $episode->setTitle($faker->text(30));
            $episode->setNumber($faker->numberBetween($min = 1, $max = 9));
            $episode->setSynopsis($faker->text(200));
            $episode->setSeason($this->getReference('season_' . $faker->numberBetween($min = 1, $max = 4)));
            $manager->persist($episode);
            $this->addReference('episode_' . $i, $episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }


}