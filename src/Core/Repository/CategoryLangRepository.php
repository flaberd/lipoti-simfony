<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lipoti\Shop\Core\Entity\Category;
use Lipoti\Shop\Core\Entity\CategoryLang;

class CategoryLangRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryLang::class);
    }

    public function findByLocaleAndCategory(string $locale, Category $category): ?CategoryLang
    {
        return $this->findOneBy(['locale' => $locale, 'category' => $category]);
    }
}
