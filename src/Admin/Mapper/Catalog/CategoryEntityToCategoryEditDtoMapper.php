<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Mapper\Catalog;

use Lipoti\Shop\Admin\Form\Catalog\CategoryEditDto;
use Lipoti\Shop\Admin\Form\Catalog\Translation\CategoryTranslateDto;
use Lipoti\Shop\Core\Entity\Category;
use Lipoti\Shop\Core\Entity\CategoryTranslate;

class CategoryEntityToCategoryEditDtoMapper
{
    public function __invoke(Category $source, ?CategoryEditDto $target = null): CategoryEditDto
    {
        if (!$target) {
            $target = new CategoryEditDto();
        }

        $target->setStatus($source->getStatus());
        $target->setParent($source->getParent());
        $target->setSlug($source->getSlug());

        $translations = $source->getTranslation();
        $tr = [];
        /** @var CategoryTranslate $translation */
        foreach ($translations as $translation) {
            $categoryTranslateDto = new CategoryTranslateDto();
            $categoryTranslateDto->setName($translation->getName());
            $tr[$translation->getLocale()] = $categoryTranslateDto;
        }
        $target->setTranslation($tr);

        return $target;
    }
}
