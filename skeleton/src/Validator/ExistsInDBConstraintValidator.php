<?php

namespace App\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class ExistsInDBConstraintValidator
 * @package App\Validator
 */
class ExistsInDBConstraintValidator extends ConstraintValidator
{
    /**
     * ExistsInDBConstraintValidator constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(protected EntityManagerInterface $entityManager)
    {

    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ExistsInDBConstraint) {
            throw new UnexpectedTypeException($constraint, ExistsInDBConstraint::class);
        }

        if (null === $value || '' === $value || $this->entityManager->getRepository($constraint->entity)->findOneBy([$constraint->field => $value])) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->setParameter('{{ field }}', $constraint->field)
            ->setParameter('{{ entity }}', $constraint->entity)
            ->addViolation();
    }
}