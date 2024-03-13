<?php

namespace App\Services;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\TaxNumber;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService extends BaseService
{
    /**
     * ProductService constructor.
     * @param EntityManagerInterface $entityManager
     * @param PaypalPaymentProcessor $paypalPaymentProcessor
     * @param StripePaymentProcessor $stripePaymentProcessor
     */
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected PaypalPaymentProcessor $paypalPaymentProcessor,
        protected StripePaymentProcessor $stripePaymentProcessor,
    )
    {
        parent::__construct($entityManager);
    }

    /**
     * @param array $data
     * @return array
     */
    public function purchase(array $data = []): array
    {
        $price = $this->calculatePrice($data);
        $processor = $data['paymentProcessor'];

        if ($processor === Product::PROCESSOR_PAYPAL) {
            try {
                $this->paypalPaymentProcessor->pay(intval($price));
            } catch (Exception $exception) {
                return [
                    'error' => "Something went wrong in $processor"
                ];
            }
        }
        if ($processor === Product::PROCESSOR_STRIPE && !$this->stripePaymentProcessor->processPayment($price)) {
            return [
                'error' => "Something went wrong in $processor"
            ];
        }

        return [
            'message' => "Paid $price via $processor"
        ];
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