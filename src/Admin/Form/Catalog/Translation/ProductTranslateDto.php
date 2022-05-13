<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog\Translation;

use Symfony\Component\Validator\Constraints as Assert;

class ProductTranslateDto
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     minMessage="Name must be at least {{ limit }} characters",
     *     maxMessage="Name cannot be longer than {{ limit }} characters"
     * )
     */
    public string $name;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=2,
     *     minMessage="Name must be at least {{ limit }} characters",
     * )
     */
    public string $description;

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
}
