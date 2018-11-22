<?php

namespace Netiul\DoctrineMoneyModule\TestAsset\Model;

use Money\Money;

class HasMoneyPropertyModel
{
    /**
     * @var Money
     */
    protected $price;

    /**
     * @return Money
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param Money $price
     */
    public function setPrice(Money $price)
    {
        $this->price = $price;
    }
}
