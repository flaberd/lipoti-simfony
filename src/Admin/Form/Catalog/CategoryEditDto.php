<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog;

use Lipoti\Shop\Core\Entity\Category;

class CategoryEditDto
{
    private bool $status = false;

    private ?Category $parent = null;

    private $translation;

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
}
