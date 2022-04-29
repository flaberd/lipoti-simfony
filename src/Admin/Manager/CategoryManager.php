<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Lipoti\Shop\Admin\Form\Catalog\CategoryEditDto;
use Lipoti\Shop\Admin\Form\Catalog\Translation\CategoryLangDto;
use Lipoti\Shop\Core\Entity\Category;
use Lipoti\Shop\Core\Entity\CategoryLang;
use Lipoti\Shop\Core\Repository\CategoryLangRepository;
use Lipoti\Shop\Core\Repository\CategoryRepository;
use Symfony\Component\String\Slugger\AsciiSlugger;

class CategoryManager
{
    private EntityManagerInterface $em;

    private CategoryLangRepository $categoryLangRepo;

    private CategoryRepository $categoryRepo;

    public function __construct(
        EntityManagerInterface $em,
        CategoryLangRepository $categoryLangRepo,
        CategoryRepository $categoryRepo
    ) {
        $this->em = $em;
        $this->categoryLangRepo = $categoryLangRepo;
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

        /** @var CategoryLangDto $translate */
        foreach ($translation as $langKey => $translate) {
            $categoryLang = new CategoryLang();
            $categoryLang->setLocale($langKey);
            $categoryLang->setCategory($category);
            $categoryLang->setName($translate->getName());
            $this->em->persist($categoryLang);
        }

        $this->em->flush();
    }

    public function update(CategoryEditDto $dto, Category $category): void
    {
        $translation = $dto->getTranslation();
        /** @var CategoryLangDto $translate */
        foreach ($translation as $langKey => $translate) {
            $categoryLang = $this->categoryLangRepo->findByLocaleAndCategory($langKey, $category);
            $categoryLang->setName($translate->getName());
            $this->em->persist($categoryLang);
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
