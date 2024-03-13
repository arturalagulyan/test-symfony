<?php

namespace App\Services;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\TaxNumber;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService extends BaseService
{
    /**
     * @param array $data
     * @return bool
     */
    public function purchase(array $data = []): bool
    {
        return true;
    }

    /**
     * @param array $data
     * @return int
     */
    public function calculatePrice(array $data = []): int
    {
        $product = $this->entityManager->getRepository(Product::class)->find($data['product']);
        $price = (float)$product->getPrice();

        if (isset($data['couponCode'])) {
            $coupon = $this->entityManager->getRepository(Coupon::class)->findOneBy(['code' => $data['couponCode']]);
            $price -= match ($coupon->getType()) {
                Coupon::TYPE_VALUE => $coupon->getValue(),
                Coupon::TYPE_PERCENT => $price * $coupon->getValue() / 100,
            };
        }

        $country = substr($data['taxNumber'], 0, 2);
        $number = substr($data['taxNumber'], 2);
        $taxNumber = $this->entityManager->getRepository(TaxNumber::class)->findOneBy([
            'number' => $number,
            'country' => $country,
        ]);
        $price += $price * $taxNumber->getTax() / 100;

        return $price;
    }
}