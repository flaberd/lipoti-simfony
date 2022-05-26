<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog;

class SearchProductDto
{
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
