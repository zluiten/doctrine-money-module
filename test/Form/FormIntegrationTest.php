<?php

namespace Netiul\DoctrineMoneyModule\Form;

use StdClass;
use PHPUnit_Framework_TestCase as TestCase;
use Money\Money;
use Money\InvalidArgumentException;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\Form\FormElementManager;
use Zend\Stdlib\Hydrator\ClassMethods;
use Netiul\DoctrineMoneyModule\Form\Factory\MoneyFieldsetFactory;
use Netiul\Test\DoctrineMoneyModule\TestAsset\Model\HasMoneyPropertyModel;
use Zend\Stdlib\Hydrator\ObjectProperty;

class FormIntegrationTest extends TestCase
{
    /**
     * @return MoneyFieldset
     */
    private function getMoneyFieldset()
    {
        $factory = new MoneyFieldsetFactory();
        $formManager = $this->getMock(FormElementManager::class);

        return $factory($formManager);
    }

    public function testElementDirectlyInTheForm()
    {
        $element = $this->getMoneyFieldset();
        $element->init();

        $form = new Form();
        $form->setHydrator(new ObjectProperty());
        $form->setObject(new StdClass());
        $form->add($element, ['name' => 'money']);

        $this->assertFalse($form->setData([])->isValid());
        $this->assertFalse($form->setData(['money' => ['amount' => '123', 'currency' => '']])->isValid());
        $this->assertFalse($form->setData(['money' => ['amount' => '', 'currency' => 'BRL']])->isValid());

        $data = [
            'money' => [
                'amount' => '500.20',
                'currency' => 'BRL',
            ],
        ];

        $form->setData($data);

        $this->assertTrue($form->isValid());

        $amountValue = $form->get('money')->get('amount')->getValue();
        $currencyValue = $form->get('money')->get('currency')->getValue();
        $object = $form->getData()->money;

        $this->assertSame('500.20', $amountValue);
        $this->assertSame('BRL', $currencyValue);
        $this->assertInstanceOf(Money::class, $object);
        $this->assertSame(50020, $object->getAmount());
        $this->assertSame('BRL', $object->getCurrency()->getName());
    }

    public function testElementInAFieldsetForSomeModel()
    {
        $element = $this->getMoneyFieldset();
        $element->init();

        $fieldset = new Fieldset('hasMoneyElementFieldset');
        $fieldset->add($element, ['name' => 'price']);
        $fieldset->setHydrator(new ClassMethods());
        $fieldset->setUseAsBaseFieldset(true);

        $form = new Form();
        $form->add($fieldset);

        // todo: can't load this
        $form->bind(new HasMoneyPropertyModel());

        $data = [
            'hasMoneyElementFieldset' => [
                'price' => [
                    'amount' => '500.25',
                    'currency' => 'BRL',
                ],
            ],
        ];

        $form->setData($data);
        $this->assertTrue($form->isValid());

        $amountValue = $form->get('hasMoneyElementFieldset')->get('price')->get('amount')->getValue();
        $currencyValue = $form->get('hasMoneyElementFieldset')->get('price')->get('currency')->getValue();
        $object = $form->getData();

        $this->assertSame('500.25', $amountValue);
        $this->assertSame('BRL', $currencyValue);
        $this->assertInstanceOf(Money::class, $object->getPrice());
        $this->assertSame(50025, $object->getPrice()->getAmount());
        $this->assertSame('BRL', $object->getPrice()->getCurrency()->getName());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The value could not be parsed as money
     */
    public function testValueCouldNotBeParsedAsMoney()
    {
        $element = $this->getMoneyFieldset();
        $element->init();

        $form = new Form();
        $form->add($element, ['name' => 'money']);

        $this->assertFalse($form->setData(['money' => ['amount' => 'bad', 'currency' => 'BRL']])->isValid());
    }
}
