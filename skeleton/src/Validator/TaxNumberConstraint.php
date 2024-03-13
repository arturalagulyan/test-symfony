<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class TaxNumberConstraint extends Constraint
{
    /**
     * @var string
     */
    public string $message = 'The {{ value }} is not valid';
}