<?php


namespace App\DataFixtures;

use Faker;
use App\DataFixtures\ProgramFixtures;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<50; $i++){
            $season = new Season();
            $faker = Faker\Factory::create('fr_FR');
            $season->setProgram($this->getReference('program_' . $faker->numberBetween($min = 0, $max = 4)));
            $season->setNumber($faker->numberBetween($min = 1, $max = 9));
            $season->setDescription($faker->text(200));
            $manager->persist($season);
            $this->addReference('season_' . $i, $season);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

}