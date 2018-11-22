<?php

namespace Netiul\DoctrineMoneyModule\Form;

use Zend\Form\Element\Number;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Netiul\DoctrineMoneyModule\Form\Element\CurrencySelect;
use Netiul\DoctrineMoneyModule\InputFilter\MoneyInputFilter;

class MoneyFieldset extends Fieldset implements InputFilterProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->add([
            'type' => Number::class,
            'name' => 'amount',
            'options' => [
                'label' => 'Amount',
            ],
            'attributes' => [
                'step' => '0.01',
            ],
        ]);

        $this->add([
            'type' => CurrencySelect::class,
            'name' => 'currency',
            'options' => [
                'label' => 'Currency',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getInputFilterSpecification()
    {
        return ['type' => MoneyInputFilter::class];
    }
}
