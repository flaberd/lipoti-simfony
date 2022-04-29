<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Lipoti\Shop\Admin\Filter\Catalog\CategoryListFilter;
use Lipoti\Shop\Core\Entity\Category;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findAllByFilter(CategoryListFilter $filter): Query
    {
        $category = $this->createQueryBuilder('c')
            ->leftJoin('c.translation', 'cl')
            ->andWhere('cl.locale = :locale')
            ->setParameter('locale', $filter->getLocale())
//            ->andWhere('p.status = :status')
//            ->setParameter('status', Category::STATUS_PUBLISHED)
        ;

        if ($filter->getStatus() !== null) {
            $category->andWhere('c.status = :status')
                ->setParameter('status', $filter->getStatus())
            ;
        }

        if ($filter->getQuery() !== null) {
            $category->andWhere('cl.name LIKE :search_query')
                ->setParameter('search_query', '%' . $filter->getQuery() . '%')
            ;
        }

        return $category->getQuery();
    }

    public function findBySlug(string $slug)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.slug LIKE :slug')
            ->setParameter('slug', $slug . '%')
            ->getQuery()
            ->getResult()
        ;
    }
}
