<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Lipoti\Shop\Admin\Form\Catalog\CategoryEditDto;
use Lipoti\Shop\Admin\Form\Catalog\Translation\CategoryLangDto;
use Lipoti\Shop\Core\Entity\Category;
use Lipoti\Shop\Core\Repository\CategoryLangRepository;

class CategoryManager
{
    private EntityManagerInterface $em;

    private CategoryLangRepository $categoryLangRepo;

    public function __construct(EntityManagerInterface $em, CategoryLangRepository $categoryLangRepo)
    {
        $this->em = $em;
        $this->categoryLangRepo = $categoryLangRepo;
    }

    public function update(CategoryEditDto $dto, Category $category): void
    {
        /** @var CategoryLangDto $translate */
        foreach ($dto->getTranslation() as $langKey => $translate) {
            $categoryLang = $this->categoryLangRepo->findByLocaleAndCategory($langKey, $category);
            $categoryLang->setName($translate->getName());
            $this->em->persist($categoryLang);
        }
        $category->setStatus($dto->getStatus());
        $category->setParent($dto->getParent());
        $this->em->persist($category);
        $this->em->flush();
    }
}
