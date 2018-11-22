<?php

namespace Netiul\DoctrineMoneyModule\Form\Element\Factory;

use Zend\Form\FormElementManager;
use Netiul\DoctrineMoneyModule\Form\Element\CurrencySelect;
use InvalidArgumentException;

class CurrencySelectFactory
{
    /**
     * @param FormElementManager $formElementManager
     *
     * @return CurrencySelect
     */
    public function __invoke(FormElementManager $formElementManager)
    {
        $serviceManager = $formElementManager->getServiceLocator();
        $config = $serviceManager->get('Config');

        if (!isset($config['money']['currencies'])) {
            throw new InvalidArgumentException('Couldn\'t find currencies configuration.');
        }

        $select = new CurrencySelect();
        $select->setValueOptions($config['money']['currencies']);

        return $select;
    }
}
