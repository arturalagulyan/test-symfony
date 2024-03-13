<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class BaseController extends AbstractController
{
    protected function validationResponse(ConstraintViolationListInterface $errors): JsonResponse
    {
        $errorResponse = [];

        foreach ($errors as $error) {
            $errorResponse[$error->getPropertyPath()] = $error->getMessage();
        }

        return $this->json([
            'errors' => $errorResponse
        ]);
    }
}