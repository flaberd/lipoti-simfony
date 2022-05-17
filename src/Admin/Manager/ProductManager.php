<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Lipoti\Shop\Admin\Form\Catalog\ProductEditDto;
use Lipoti\Shop\Admin\Form\Catalog\Translation\ProductTranslateDto;
use Lipoti\Shop\Admin\Repository\ProductRepository;
use Lipoti\Shop\Admin\Repository\ProductTranslateRepository;
use Lipoti\Shop\Core\Entity\Product;
use Symfony\Component\String\Slugger\AsciiSlugger;

class ProductManager
{
    private EntityManagerInterface $em;

    private ProductTranslateRepository $productTranslateRepo;

    private ProductRepository $productRepo;

    public function __construct(
        EntityManagerInterface $em,
        ProductTranslateRepository $productTranslateRepo,
        ProductRepository $productRepo
    ) {
        $this->em = $em;
        $this->productTranslateRepo = $productTranslateRepo;
        $this->productRepo = $productRepo;
    }

    public function update(ProductEditDto $dto, Product $product): void
    {
        $translation = $dto->getTranslation();
        /** @var ProductTranslateDto $translate */
        foreach ($translation as $langKey => $translate) {
            $productTranslate = $this->productTranslateRepo->findByLocaleAndProduct($langKey, $product);
            $productTranslate->setName($translate->getName());
            $productTranslate->setDescription($translate->getDescription());
            $this->em->persist($productTranslate);
        }
        $product->setStatus($dto->getStatus());
        $product->setCategory($dto->getCategory());

        if ($product->getSlug() !== $dto->getSlug()) {
            $slugger = new AsciiSlugger();
            $slug = $slugger->slug($dto->getSlug() ?? $translation[\Locale::getDefault()]->getName())->toString();

            $duplicateSlugs = $this->productRepo->findBySlug($slug);
            if (!empty($duplicateSlugs)) {
                $slugSufix = [];
                foreach ($duplicateSlugs as $duplicateSlug) {
                    $slugSufix[] = (int) str_replace([$slug, '_'], '', $duplicateSlug->getSlug());
                }
                $slug .= '_' . (max($slugSufix) + 1);
            }

            $product->setSlug($slug);
        }
        $this->em->persist($product);
        $this->em->flush();
    }
}
