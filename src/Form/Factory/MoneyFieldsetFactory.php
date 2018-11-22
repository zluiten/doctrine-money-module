<?php

namespace Netiul\DoctrineMoneyModule\Form\Factory;

use Money\Money;
use Netiul\DoctrineMoneyModule\Form\MoneyFieldset;
use Netiul\DoctrineMoneyModule\Hydrator\MoneyHydrator;

class MoneyFieldsetFactory
{
    /**
     * @return MoneyFieldset
     */
    public function __invoke()
    {
        $moneyFieldset = new MoneyFieldset();
        $moneyFieldset->setHydrator(new MoneyHydrator());
        $moneyFieldset->setObject(Money::BRL(0));

        return $moneyFieldset;
    }
}
