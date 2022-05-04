<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Lipoti\Shop\Core\Entity\Product;
use Lipoti\Shop\Core\Entity\ProductTranslate;
use Symfony\Component\String\Slugger\AsciiSlugger;

class ProductFixtures extends Fixture implements DependentFixtureInterface
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
        for ($i = 0; $i < 50; $i++) {
            $product = new Product();
            $product->setStatus(1);
            $product->setCategory($this->getReference('sub_category_parent_' . random_int(0, 19)));
            $slug = $slugger->slug('_product_' . $i)->toString();
            $product->setSlug($slug);
            $this->em->persist($product);

            foreach ($this->locales as $locale) {
                $productTranslate = new ProductTranslate();
                $productTranslate->setName($locale . '_product_' . $i);
                $productTranslate->setDescription('description - ' . $locale . '_product_' . $i);
                $productTranslate->setLocale($locale);
                $productTranslate->setProduct($product);
                $this->em->persist($productTranslate);
            }
        }
        $this->em->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
