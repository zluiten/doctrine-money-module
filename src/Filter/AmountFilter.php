<?php

namespace Netiul\DoctrineMoneyModule\Filter;

use Money\InvalidArgumentException;
use Money\Money;
use Zend\Filter\AbstractFilter;

class AmountFilter extends AbstractFilter
{
    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException
     *
     * @return int|null
     */
    public function filter($value)
    {
        if (null === $value || (is_string($value) && strlen($value) === 0)) {
            return null;
        }

        return \Money\Number::fromNumber($value)->getIntegerPart();
    }
}
