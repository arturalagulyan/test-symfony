<?php

namespace App\Validator;

use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ExistsInDBConstraint extends Constraint
{
    /**
     * @var string
     */
    public string $message = 'The {{ field }}:{{ value }} does not exist in {{ entity }}';

    /**
     * ExistsInDBConstraint constructor.
     * @param string $entity
     * @param string $field
     */
    #[HasNamedArguments]
    public function __construct(
        public string $entity,
        public string $field,
    ) {
        parent::__construct([]);
    }
}