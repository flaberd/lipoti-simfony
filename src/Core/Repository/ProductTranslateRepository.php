<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lipoti\Shop\Core\Entity\Product;
use Lipoti\Shop\Core\Entity\ProductTranslate;

class ProductTranslateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductTranslate::class);
    }

    public function findByLocaleAndProduct(string $locale, Product $product): ?ProductTranslate
    {
        return $this->findOneBy(['locale' => $locale, 'product' => $product]);
    }
}
