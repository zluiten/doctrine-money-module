<?php

namespace Netiul\DoctrineMoneyModule\InputFilter;

use Zend\Filter\StringToUpper;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Netiul\DoctrineMoneyModule\Filter\AmountFilter;

class MoneyInputFilter extends InputFilter
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->add([
            'name' => 'amount',
            'required' => true,
            'filters' => [
                ['name' => AmountFilter::class],
            ],
            'validators' => [
                ['name' => NotEmpty::class],
            ],
        ]);

        $this->add([
            'name' => 'currency',
            'required' => true,
            'filters' => [
                ['name' => StringToUpper::class],
            ],
            'validators' => [
                ['name' => NotEmpty::class],
            ],
        ]);
    }
}
