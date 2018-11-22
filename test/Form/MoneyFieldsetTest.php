<?php

namespace Netiul\DoctrineMoneyModule\Form;

use Money\Currency;
use Money\Money;
use PHPUnit_Framework_TestCase as TestCase;
use Zend\Form\FormElementManager;
use Netiul\DoctrineMoneyModule\Form\Factory\MoneyFieldsetFactory;

class MoneyFieldsetTest extends TestCase
{
    public function testCanHydrateMoneyWithInteger()
    {
        $fieldset = $this->getMoneyFieldset();

        $fieldset->bindValues([
            'amount' => 500,
            'currency' => 'BRL',
        ]);
        $this->assertInstanceOf(Money::class, $fieldset->getObject());
    }

    /**
     * @return MoneyFieldset
     */
    private function getMoneyFieldset()
    {
        $factory = new MoneyFieldsetFactory();
        $formManager = $this->getMock(FormElementManager::class);

        return $factory($formManager);
    }

    public function testCanHydrateMoneyWithString()
    {
        $fieldset = $this->getMoneyFieldset();

        $fieldset->bindValues([
            'amount' => '500',
            'currency' => 'BRL',
        ]);

        $this->assertInstanceOf(Money::class, $fieldset->getObject());
    }
}
