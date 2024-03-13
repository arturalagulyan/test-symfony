<?php

namespace App\Dto\Products;

use App\Dto\BaseDto;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Validator\ExistsInDBConstraint;
use App\Validator\TaxNumberConstraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CalculatePriceDto
 * @package App\Dto\Products
 */
class CalculatePriceDto extends BaseDto
{
    /**
     * CalculatePriceDto constructor.
     * @param int $product
     * @param string $taxNumber
     * @param string|null $couponCode
     */
    public function __construct(
        #[Assert\NotBlank]
        #[ExistsInDBConstraint(entity: Product::class, field: 'id')]
        public int $product,

        #[Assert\NotBlank]
        #[TaxNumberConstraint]
        public string $taxNumber,

        #[ExistsInDBConstraint(entity: Coupon::class, field: 'code')]
        public ?string $couponCode,
    ) {
    }
}