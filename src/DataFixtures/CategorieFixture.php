<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategorieFixture extends Fixture
{
    private $counter = 1;
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $parent = $this->creatCategory('Informatique', null, $manager);

        $this->creatCategory('Ordinateurs portables', $parent, $manager);
        $this->creatCategory('Ecrans', $parent, $manager);
        $this->creatCategory('Souris', $parent, $manager);
        $this->creatCategory('Claviers', $parent, $manager);

        $parent = $this->creatCategory('Mode', null, $manager);

        $this->creatCategory('Homme', $parent, $manager);
        $this->creatCategory('Femme', $parent, $manager);
        $this->creatCategory('Enfant', $parent, $manager);

        $manager->flush();
    }

    public function creatCategory(string $name, Categorie $parent = null, ObjectManager $manager)
    {

        $category = new Categorie();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $category->setParent($parent);
        $manager->persist($category);

        $this->addReference('cat-' . $this->counter, $category);
        $this->counter++;
        return $category;
    }
}
