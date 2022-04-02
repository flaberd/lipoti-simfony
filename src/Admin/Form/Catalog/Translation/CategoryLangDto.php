<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog\Translation;

use Symfony\Component\Validator\Constraints as Assert;

class CategoryLangDto
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
    public static $name;

    /**
     * @return mixed
     */
    public static function getName()
    {
        return self::$name;
    }

    /**
     * @param mixed $name
     */
    public static function setName($name): void
    {
        self::$name = $name;
    }
}
