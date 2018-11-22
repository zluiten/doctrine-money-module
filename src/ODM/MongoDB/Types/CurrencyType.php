<?php

namespace Netiul\DoctrineMoneyModule\ODM\MongoDB\Types;

use Doctrine\ODM\MongoDB\Types\Type;
use Money\Currency;

class CurrencyType extends Type
{
    const NAME = 'currency';

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @param mixed $value
     *
     * @return null|string
     */
    public function convertToDatabaseValue($value)
    {
        return (string) $value;
    }

    /**
     * @param string $value
     *
     * @return string|Currency
     *
     * @throws \Money\UnknownCurrencyException
     */
    public function convertToPHPValue($value)
    {
        if ($value === null || $value instanceof Currency) {
            return $value;
        }

        return new Currency($value);
    }

    public function closureToPHP()
    {
        return '$return = new \Money\Currency($value);';
    }
}
