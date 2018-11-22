<?php

namespace Netiul\DoctrineMoneyModule\DBAL\Types;

use Doctrine\DBAL\Types\StringType;
use Money\Currency;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class CurrencyType extends StringType
{
    const NAME = 'currency';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof Currency) {
            return $value;
        }

        return new Currency($value);
    }
}
