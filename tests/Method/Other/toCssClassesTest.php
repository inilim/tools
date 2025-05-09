<?php

namespace Inilim\Tool\Test\Method\Other;

use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;
use Inilim\Tool\Test\ForTest\ClassStringable;

class toCssClassesTest extends TestCase
{
    function test()
    {
        $classes = Other::toCssClasses([
            'font-bold',
            'mt-4',
        ]);

        $this->assertSame('font-bold mt-4', $classes);

        $classes = Other::toCssClasses([
            'font-bold',
            'mt-4',
            'ml-2' => true,
            'mr-2' => false,
        ]);

        $this->assertSame('font-bold mt-4 ml-2', $classes);
    }
}
