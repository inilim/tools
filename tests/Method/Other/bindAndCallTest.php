<?php

declare(strict_types=1);

use Inilim\Tool\Other;
use Inilim\Tool\Test\ForTest\ClassicClass;

class bindAndCallTest extends \Inilim\Tool\Test\TestCase
{
    function test()
    {
        $object = new class() {};
        $expect = \get_class($object);
        $class = Other::bindAndCall($object, function () {
            return \get_class($this);
        });

        $this->assertSame($expect, $class);

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        $expect = \mt_rand(1, 1000);
        $object = new class($expect) {
            private int $prop;
            function __construct($value)
            {
                $this->prop = $value;
            }
        };

        $value = Other::bindAndCall($object, function () {
            return $this->prop ?? null;
        });
        $this->assertSame($expect, $value);
    }
}
