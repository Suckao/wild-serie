<?php


namespace App\DataFixtures;

use Faker;
use App\DataFixtures\CategoryFixtures;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'The Walking Dead' => [
            'summary' => 'Summary fixture text of The Walking Dead',
            'category' => 'Categorie_11',
        ],
        'The Haunting of Hill House' => [
            'summary' => 'Summary fixture text of The Haunting of Hill House',
            'category' => 'Categorie_11',
        ],
        'American Horror Story' => [
            'summary' => 'Summary fixture text of American Horror Story',
            'category' => 'Categorie_11',
        ],
        'Penny Dreadful' => [
            'summary' => 'Summary fixture text of Penny Dreadful',
            'category' => 'Categorie_11',
        ],
        'Fear The Walking Dead' => [
            'summary' => 'Summary fixture text of Fear The Walking Dead',
            'category' => 'Categorie_11',
        ],
    ];

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::PROGRAMS as $title => $data){
            $program = new Program();
            $program->setTitle($title);
            $program->setSummary($data['summary']);
            $this->addReference('program_' . $i, $program);
            $i++;
            $program->setCategory($this->getReference('categorie_0'));
            $manager ->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}