<?php

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\TaxNumber;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadCoupons($manager);
        $this->loadProducts($manager);
        $this->loadTaxNumbers($manager);
    }

    protected function loadProducts(ObjectManager $manager): void
    {
        foreach ($this->getProducts() as $item) {
            $product = new Product();
            $product->setName($item['name']);
            $product->setPrice($item['price']);
            $manager->persist($product);
        }

        $manager->flush();
    }

    protected function loadCoupons(ObjectManager $manager): void
    {
        foreach ($this->getCoupons() as $item) {
            $coupon = new Coupon();
            $coupon->setName($item['name']);
            $coupon->setCode($item['code']);
            $coupon->setType($item['type']);
            $coupon->setValue($item['value']);
            $manager->persist($coupon);
        }

        $manager->flush();
    }

    protected function loadTaxNumbers(ObjectManager $manager): void
    {
        foreach ($this->getTaxNumbers() as $item) {
            $taxNumber = new TaxNumber();
            $taxNumber->setTax($item['tax']);
            $taxNumber->setName($item['name']);
            $taxNumber->setNumber($item['number']);
            $taxNumber->setCountry($item['country']);
            $manager->persist($taxNumber);
        }

        $manager->flush();
    }

    protected function getProducts(): array
    {
        return [
            [
                'name' => 'Iphone',
                'price' => 100.00,
            ],
            [
                'name' => 'Headphones',
                'price' => 20.00,
            ],
            [
                'name' => 'Case',
                'price' => 10.00,
            ]
        ];
    }

    protected function getCoupons(): array
    {
        return [
            [
                'code' => 'P10',
                'name' => 'Percent 10',
                'value' => 10,
                'type' => Coupon::TYPE_PERCENT,
            ],
            [
                'code' => 'P30',
                'name' => 'Percent 30',
                'value' => 30,
                'type' => Coupon::TYPE_PERCENT,
            ],
            [
                'code' => 'V10',
                'name' => 'Value 10',
                'value' => 10,
                'type' => Coupon::TYPE_VALUE,
            ],
            [
                'code' => 'V50',
                'name' => 'Value 50',
                'value' => 50,
                'type' => Coupon::TYPE_VALUE,
            ],
        ];
    }

    protected function getTaxNumbers(): array
    {
        return [
            [
                'name' => 'Italian Tax',
                'country' => 'IT',
                'number' => '0123456789',
                'tax' => 22,
            ],
            [
                'name' => 'Italian Tax 2',
                'country' => 'IT',
                'number' => '9876543210',
                'tax' => 32,
            ],
            [
                'name' => 'French Tax',
                'country' => 'FR',
                'number' => 'AA0123456789',
                'tax' => 20,
            ],
            [
                'name' => 'French Tax 2',
                'country' => 'FR',
                'number' => 'AA9876543210',
                'tax' => 30,
            ],
            [
                'name' => 'German Tax',
                'country' => 'DE',
                'number' => '0123456789',
                'tax' => 19,
            ],
            [
                'name' => 'German Tax 2',
                'country' => 'DE',
                'number' => '9876543210',
                'tax' => 29,
            ],
        ];
    }
}
