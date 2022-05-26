<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Lipoti\Shop\Admin\Filter\Catalog\ProductListFilter;
use Lipoti\Shop\Core\Entity\Product;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findAllByFilter(ProductListFilter $filter): Query
    {
        $category = $this->createQueryBuilder('p')
            ->leftJoin('p.translation', 'pl')
            ->andWhere('pl.locale = :locale')
            ->setParameter('locale', $filter->getLocale())
            ->orderBy('p.id', 'DESC')
        ;
//            ->andWhere('p.status = :status')
//            ->setParameter('status', Category::STATUS_PUBLISHED)

//        if ($filter->getStatus() !== null) {
//            $category->andWhere('p.status = :status')
//                ->setParameter('status', $filter->getStatus())
//            ;
//        }

        if ($filter->getName() !== null) {
            $category->andWhere('pl.name LIKE :search_name')
                ->setParameter('search_name', '%' . $filter->getName() . '%')
            ;
        }

        return $category->getQuery();
    }

    public function findBySlug(string $slug)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.slug LIKE :slug')
            ->setParameter('slug', $slug . '%')
            ->getQuery()
            ->getResult()
            ;
    }
}
