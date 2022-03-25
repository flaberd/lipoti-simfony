<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lipoti\Shop\Admin\Filter\Catalog\CategoryListFilter;
use Lipoti\Shop\Core\Entity\Category;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return \Doctrine\ORM\Query
     */
    public function findAllByFilter(CategoryListFilter $filter)
    {
        $category = $this->createQueryBuilder('c')
//            ->select('c.id')
            ->leftJoin('c.lang', 'cl')
            ->andWhere('cl.lang = :locale')
            ->setParameter('locale', $filter->getLocale())
//            ->addSelect('cl.name')
//            ->andWhere('p.status = :status')
//            ->setParameter('status', Category::STATUS_PUBLISHED)
        ;

        if ($filter->getQuery() !== null) {
            $category->andWhere('cl.name LIKE :search_query')
                ->setParameter('search_query', '%' . $filter->getQuery() . '%')
            ;
        }

        return $category->getQuery();
    }
}
