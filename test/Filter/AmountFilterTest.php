<?php

namespace Netiul\DoctrineMoneyModule\Filter;

use PHPUnit_Framework_TestCase as TestCase;

class AmountFilterTest extends TestCase
{
    public function testFiltersValueAsExpected()
    {
        $filter = new AmountFilter();

        $this->assertSame(20000, $filter->filter(200));

        $this->assertSame(20000, $filter->filter('200'));

        $this->assertSame(0, $filter->filter(0));

        $this->assertSame(0, $filter->filter('0'));
    }

    public function testShouldNotFilterEmpty()
    {
        $filter = new AmountFilter();

        $this->assertNull($filter->filter(''));

        $this->assertNull($filter->filter(null));
    }
}
