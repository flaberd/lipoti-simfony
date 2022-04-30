<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lipoti\Shop\Common\Entity\Traits\IdentifiableEntityTrait;

/**
 * @ORM\Entity
 */
class ProductTranslate
{
    use IdentifiableEntityTrait;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="translation")
     * @ORM\JoinColumn(nullable=false)
     */
    private Product $product;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private string $locale;

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }
}
