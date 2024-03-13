<?php

namespace App\Controller;

use App\Dto\Products\CalculatePriceDto;
use App\Dto\Products\PurchaseDto;
use App\Services\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class ProductController
 * @package App\Controller
 */
class ProductController extends BaseController
{
    /**
     * ProductController constructor.
     * @param ProductService $service
     */
    public function __construct(protected ProductService $service)
    {

    }

    /**
     * @param PurchaseDto $dto
     * @return JsonResponse
     */
    #[Route('/purchase', name: 'product_purchase', methods: ['POST'], format: 'json')]
    public function purchase(#[MapRequestPayload(acceptFormat: 'json')] PurchaseDto $dto): JsonResponse
    {
        return $this->json($this->service->purchase($dto->getRequestParams()));
    }

    /**
     * @param CalculatePriceDto $dto
     * @return JsonResponse
     */
    #[Route('/calculate-price', name: 'product_calculate_price', methods: ['POST'], format: 'json')]
    public function calculatePrice(#[MapRequestPayload(acceptFormat: 'json')] CalculatePriceDto $dto): JsonResponse
    {
        return $this->json([
            'price' => $this->service->calculatePrice($dto->getRequestParams())
        ]);
    }
}
