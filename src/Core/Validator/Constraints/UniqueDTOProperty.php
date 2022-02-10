<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 * @Target({"PROPERTY"})
 */
class UniqueDTOProperty extends Constraint
{
    public const IS_NOT_UNIQUE = '2911c98d-a845-4db0-94b7-b0dbc36bc51a';

    public string $message = 'This value is already used.';

    public string $entityClass;

    public string $entityProperty;

    protected static $errorNames = [
        self::IS_NOT_UNIQUE => 'IS_NOT_UNIQUE',
    ];

    public function getRequiredOptions(): array
    {
        return ['entityClass', 'entityProperty'];
    }

    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
