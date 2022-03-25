<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog;

class SearchCategoryDto
{
    private ?string $query = null;

    private ?string $status = null;

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(?string $query): void
    {
        $this->query = $query;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }
}
