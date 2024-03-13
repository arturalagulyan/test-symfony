<?php

namespace App\Dto;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class BaseDto
 * @package App\Dto
 */
abstract class BaseDto
{
//    public function __construct(protected ValidatorInterface $validator)
//    {
//
//    }
//
//    public function validate(): ConstraintViolationListInterface
//    {
//        return $this->validator->validate($this);
//    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return Request::createFromGlobals();
    }

    /**
     * @return array
     */
    public function getRequestParams(): array
    {
        return $this->getRequest()->toArray();
    }
}