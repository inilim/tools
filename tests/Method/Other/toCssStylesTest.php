<?php

namespace Inilim\Tool\Test\Method\Other;

use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;
use Inilim\Tool\Test\ForTest\ClassStringable;

class toCssStylesTest extends TestCase
{
    function test()
    {
        $styles = Other::toCssStyles([
            'font-weight: bold',
            'margin-top: 4px;',
        ]);

        $this->assertSame('font-weight: bold; margin-top: 4px;', $styles);

        $styles = Other::toCssStyles([
            'font-weight: bold;',
            'margin-top: 4px',
            'margin-left: 2px;' => true,
            'margin-right: 2px' => false,
        ]);

        $this->assertSame('font-weight: bold; margin-top: 4px; margin-left: 2px;', $styles);
    }
}
