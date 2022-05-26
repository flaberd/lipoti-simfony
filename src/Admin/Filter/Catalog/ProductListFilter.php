<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Filter\Catalog;

class ProductListFilter
{
    private ?string $name = null;

    private ?string $locale = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): void
    {
        $this->locale = $locale;
    }
}
