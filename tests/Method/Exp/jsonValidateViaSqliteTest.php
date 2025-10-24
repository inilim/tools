<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\Exp;
use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;

/**
 * TODO нужно еще тесты
 */
class jsonValidateViaSqliteTest extends TestCase
{
    function test()
    {
        // json_valid('{"x":35}') → 1
        // json_valid('{x:35}') → 0
        // json_valid('{x:35}',6) → 1
        // json_valid('{"x":35') → 0
        // json_valid(NULL) → NULL

        $this->assertTrue(Exp::jsonValidateViaSqlite('{"x":35}'));
        $this->assertFalse(Exp::jsonValidateViaSqlite('{x:35}'));
        $this->assertTrue(Exp::jsonValidateViaSqlite('{x:35}', 6));
        $this->assertFalse(Exp::jsonValidateViaSqlite('{"x":35'));
    }

    function testEx()
    {
        $this->expectException(\InvalidArgumentException::class);
        Exp::jsonValidateViaSqlite('{x:35}', 0);
    }

    function testEx2()
    {
        $this->expectException(\InvalidArgumentException::class);
        Exp::jsonValidateViaSqlite('{x:35}', 11);
    }
}
