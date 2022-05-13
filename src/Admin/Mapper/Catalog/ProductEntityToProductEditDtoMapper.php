<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Mapper\Catalog;

use Lipoti\Shop\Admin\Form\Catalog\ProductEditDto;
use Lipoti\Shop\Admin\Form\Catalog\Translation\ProductTranslateDto;
use Lipoti\Shop\Core\Entity\Product;
use Lipoti\Shop\Core\Entity\ProductTranslate;

class ProductEntityToProductEditDtoMapper
{
    public function __invoke(Product $source, ?ProductEditDto $target = null): ProductEditDto
    {
        if (!$target) {
            $target = new ProductEditDto();
        }

        $target->setStatus($source->getStatus());
        $target->setCategory($source->getCategory());
        $target->setSlug($source->getSlug());

        $translations = $source->getTranslation();
        $tr = [];
        /** @var ProductTranslate $translation */
        foreach ($translations as $translation) {
            $categoryTranslateDto = new ProductTranslateDto();
            $categoryTranslateDto->setName($translation->getName());
            $categoryTranslateDto->setDescription($translation->getDescription());
            $tr[$translation->getLocale()] = $categoryTranslateDto;
        }
        $target->setTranslation($tr);

        return $target;
    }
}
