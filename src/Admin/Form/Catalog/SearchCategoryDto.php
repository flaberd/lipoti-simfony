<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog;

class SearchCategoryDto
{
    private ?string $query = null;

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(?string $query): void
    {
        $this->query = $query;
    }
}
