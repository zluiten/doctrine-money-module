<?php

namespace Netiul\DoctrineMoneyModule\Hydrator;

use Money\Currency;
use PHPUnit_Framework_TestCase as TestCase;
use Money\Money;

class MoneyHydratorTest extends TestCase
{
    public function testHydratorExtractAsExpected()
    {
        $object = new Money(500, new Currency('BRL'));
        $hydrator = new MoneyHydrator();
        $extracted = $hydrator->extract($object);
        $expected = ['amount' => 500, 'currency' => $object->getCurrency()->getName()];

        $this->assertEquals($expected, $extracted);
    }

    public function testHydratorHydratesAsExpected()
    {
        $hydrator = new MoneyHydrator();
        $data = ['amount' => 500, 'currency' => 'BRL'];

        $money = new Money(500, new Currency('BRL'));
        $object = $hydrator->hydrate($data, new \stdClass());

        $this->assertEquals($money->getAmount(), $object->getAmount());
        $this->assertEquals($money->getCurrency(), $object->getCurrency());
    }
}
