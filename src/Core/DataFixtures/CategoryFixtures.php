<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Lipoti\Shop\Core\Entity\Category;
use Lipoti\Shop\Core\Entity\CategoryTranslate;
use Symfony\Component\String\Slugger\AsciiSlugger;

class CategoryFixtures extends Fixture
{
    private EntityManagerInterface $em;

    private array $locales;

    public function __construct(EntityManagerInterface $em, array $locales)
    {
        $this->em = $em;
        $this->locales = $locales;
    }

    public function load(ObjectManager $manager): void
    {
        $slugger = new AsciiSlugger();
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setStatus(1);
            $slug = $slugger->slug('_category_' . $i)->toString();
            $category->setSlug($slug);
            $this->addReference('category_parent_' . $i, $category);
            $this->em->persist($category);

            foreach ($this->locales as $locale) {
                $categoryTranslate = new CategoryTranslate();
                $categoryTranslate->setName($locale . '_category_' . $i);
                $categoryTranslate->setLocale($locale);
                $categoryTranslate->setCategory($category);
                $this->em->persist($categoryTranslate);
            }
        }

        for ($i = 0; $i < 20; $i++) {
            $category = new Category();
            $category->setParent($this->getReference('category_parent_' . random_int(0, 4)));
            $category->setStatus(1);
            $slug = $slugger->slug('_sub_category_' . $i)->toString();
            $category->setSlug($slug);
            $this->em->persist($category);

            foreach ($this->locales as $locale) {
                $categoryTranslate = new CategoryTranslate();
                $categoryTranslate->setName($locale . '_sub_category_' . $i);
                $categoryTranslate->setLocale($locale);
                $categoryTranslate->setCategory($category);
                $this->em->persist($categoryTranslate);
            }
        }

        $this->em->flush();
    }
}
