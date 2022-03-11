<?php

declare(strict_types=1);

namespace Lipoti\Shop\Category\Manager;

use Doctrine\ORM\EntityManagerInterface;

class CategoryManager
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
