<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Validator\Constraints;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueDTOPropertyValidator extends ConstraintValidator
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueDTOProperty) {
            throw new UnexpectedTypeException($constraint, UniqueDTOProperty::class);
        }

        if ($value === null) {
            return;
        }

        $em = $this->registry->getManagerForClass($constraint->entityClass);

        if ($em === null) {
            throw new \LogicException(sprintf("Unable to retrieve EntityManager for class '%s'", $constraint->entityClass));
        }

        $repository = $em->getRepository($constraint->entityClass);
        $existingObject = $repository->findOneBy([$constraint->entityProperty => $value]);

        if (!$existingObject) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setCode(UniqueDTOProperty::IS_NOT_UNIQUE)
            ->addViolation()
        ;
    }
}
