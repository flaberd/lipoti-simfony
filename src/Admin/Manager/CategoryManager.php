<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Lipoti\Shop\Admin\Form\Catalog\CategoryEditDto;
use Lipoti\Shop\Admin\Form\Catalog\Translation\CategoryTranslateDto;
use Lipoti\Shop\Core\Entity\Category;
use Lipoti\Shop\Core\Entity\CategoryTranslate;
use Lipoti\Shop\Core\Repository\CategoryRepository;
use Lipoti\Shop\Core\Repository\CategoryTranslateRepository;
use Symfony\Component\String\Slugger\AsciiSlugger;

class CategoryManager
{
    private EntityManagerInterface $em;

    private CategoryTranslateRepository $categoryTranslateRepo;

    private CategoryRepository $categoryRepo;

    public function __construct(
        EntityManagerInterface $em,
        CategoryTranslateRepository $categoryTranslateRepo,
        CategoryRepository $categoryRepo
    ) {
        $this->em = $em;
        $this->categoryTranslateRepo = $categoryTranslateRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function create(CategoryEditDto $dto): void
    {
        $category = new Category();
        $translation = $dto->getTranslation();
        $category->setStatus($dto->getStatus());
        $category->setParent($dto->getParent());

        $slugger = new AsciiSlugger();
        $slug = $slugger->slug($translation[\Locale::getDefault()]->getName())->toString();
        $duplicateSlugs = $this->categoryRepo->findBySlug($slug);
        if (!empty($duplicateSlugs)) {
            $slugSufix = [];
            foreach ($duplicateSlugs as $duplicateSlug) {
                $slugSufix[] = (int) str_replace([$slug, '_'], '', $duplicateSlug->getSlug());
            }
            $slug .= '_' . (max($slugSufix) + 1);
        }

        $category->setSlug($slug);

        $this->em->persist($category);

        /** @var CategoryTranslateDto $translate */
        foreach ($translation as $langKey => $translate) {
            $categoryTranslate = new CategoryTranslate();
            $categoryTranslate->setLocale($langKey);
            $categoryTranslate->setCategory($category);
            $categoryTranslate->setName($translate->getName());
            $this->em->persist($categoryTranslate);
        }

        $this->em->flush();
    }

    public function update(CategoryEditDto $dto, Category $category): void
    {
        $translation = $dto->getTranslation();
        /** @var CategoryTranslateDto $translate */
        foreach ($translation as $langKey => $translate) {
            $categoryTranslate = $this->categoryTranslateRepo->findByLocaleAndCategory($langKey, $category);
            $categoryTranslate->setName($translate->getName());
            $this->em->persist($categoryTranslate);
        }
        $category->setStatus($dto->getStatus());
        $category->setParent($dto->getParent());

        if ($category->getSlug() !== $dto->getSlug()) {
            $slugger = new AsciiSlugger();
            $slug = $slugger->slug($dto->getSlug() ?? $translation[\Locale::getDefault()]->getName())->toString();

            $duplicateSlugs = $this->categoryRepo->findBySlug($slug);
            if (!empty($duplicateSlugs)) {
                $slugSufix = [];
                foreach ($duplicateSlugs as $duplicateSlug) {
                    $slugSufix[] = (int) str_replace([$slug, '_'], '', $duplicateSlug->getSlug());
                }
                $slug .= '_' . (max($slugSufix) + 1);
            }

            $category->setSlug($slug);
        }
        $this->em->persist($category);
        $this->em->flush();
    }
}
