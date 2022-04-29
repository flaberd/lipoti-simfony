<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog;

use Lipoti\Shop\Core\Entity\Category;

class CategoryEditDto
{
    private int $status = 0;

    private ?Category $parent = null;

    private $translation;

    private ?string $slug = null;

    /**
     * @return bool|int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param bool|int $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getParent(): ?Category
    {
        return $this->parent;
    }

    public function setParent(?Category $parent): void
    {
        $this->parent = $parent;
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
