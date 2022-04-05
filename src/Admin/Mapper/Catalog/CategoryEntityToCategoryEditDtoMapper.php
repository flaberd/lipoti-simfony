<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Mapper\Catalog;

use Lipoti\Shop\Admin\Form\Catalog\CategoryEditDto;
use Lipoti\Shop\Admin\Form\Catalog\Translation\CategoryLangDto;
use Lipoti\Shop\Core\Entity\Category;

class CategoryEntityToCategoryEditDtoMapper
{
    public function __invoke(Category $source, ?CategoryEditDto $target = null): CategoryEditDto
    {
        if (!$target) {
            $target = new CategoryEditDto();
        }

        $target->setStatus($source->getStatus());
        $target->setParent($source->getParent());

        $translations = $source->getTranslation();
        $tr = [];
        foreach ($translations as $translation) {
            $categoryLangDto = new CategoryLangDto();
            $categoryLangDto->setName($translation->getName());
            $tr[$translation->getLocale()] = $categoryLangDto;
        }
        $target->setTranslation($tr);

        return $target;
    }
}
