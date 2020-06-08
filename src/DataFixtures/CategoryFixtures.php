<?php


namespace App\DataFixtures;

use Faker;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Horreur',
        'Aventure',
        'Suspens',
        'Policier',
        'Thriller',
        'Comedy',
        'Romantic',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $CATEGORYNAME) {
            $category = new Category();
            $category ->setName($CATEGORYNAME);
            $this->addReference('categorie_' . $key, $category);

            $manager->persist($category);
        }

        $manager->flush();
    }

}