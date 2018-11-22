<?php

namespace Netiul\DoctrineMoneyModule;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return require __DIR__.'/../config/module.config.php';
    }
}
