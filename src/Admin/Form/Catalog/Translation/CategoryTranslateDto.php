<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog\Translation;

use Symfony\Component\Validator\Constraints as Assert;

class CategoryTranslateDto
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
     * @return mixed|string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed|string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
