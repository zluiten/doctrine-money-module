<?php

namespace Netiul\DoctrineMoneyModule\Form\Factory;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Form\FormElementManager;
use Netiul\DoctrineMoneyModule\Form\MoneyFieldset;
use Money\Money;
use Netiul\DoctrineMoneyModule\Hydrator\MoneyHydrator;

class MoneyFieldsetFactoryTest extends TestCase
{
    /**
     * @var MoneyFieldset
     */
    private $fieldset;

    public function setUp()
    {
        $factory = new MoneyFieldsetFactory();
        $formManager = $this->getMock(FormElementManager::class);

        $this->fieldset = $factory($formManager);
    }

    public function testFactoryCanInstantiateFieldset()
    {
        $this->assertInstanceOf(MoneyFieldset::class, $this->fieldset);
    }

    public function testFactoryCreatesWithExpectedHydrator()
    {
        $this->assertInstanceOf(MoneyHydrator::class, $this->fieldset->getHydrator());
    }

    public function testFactoryCreatesWithExpectedObject()
    {
        $this->assertInstanceOf(Money::class, $this->fieldset->getObject());
    }
}
