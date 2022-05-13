<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog;

use Lipoti\Shop\Core\Entity\Category;

class ProductEditDto
{
    private int $status = 0;

    private Category $category;

    private $translation;

    private ?string $slug = null;

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @param mixed $translation
     */
    public function setTranslation($translation): void
    {
        $this->translation = $translation;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }
}
