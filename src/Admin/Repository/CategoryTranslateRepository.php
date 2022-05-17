<?php


namespace Lipoti\Shop\Admin\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lipoti\Shop\Core\Entity\Category;
use Lipoti\Shop\Core\Entity\CategoryTranslate;

class CategoryTranslateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryTranslate::class);
    }

    public function findByLocaleAndCategory(string $locale, Category $category): ?CategoryTranslate
    {
        return $this->findOneBy(['locale' => $locale, 'category' => $category]);
    }
}
