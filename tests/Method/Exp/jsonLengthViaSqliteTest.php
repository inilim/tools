<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\Exp;
use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;

/**
 * TODO нужно еще тесты
 */
class jsonLengthViaSqliteTest extends TestCase
{
    function test()
    {
        // json_array_length('[1,2,3,4]') → 4
        // json_array_length('[1,2,3,4]', '$') → 4
        // json_array_length('[1,2,3,4]', '$[2]') → 0
        // json_array_length('{"one":[1,2,3]}') → 0
        // json_array_length('{"one":[1,2,3]}', '$.one') → 3
        // json_array_length('{"one":[1,2,3]}', '$.two') → NULL

        $this->assertSame(4, Exp::jsonLengthViaSqlite('[1,2,3,4]'));
        $this->assertSame(4, Exp::jsonLengthViaSqlite('[1,2,3,4]', '$'));
        $this->assertSame(4, Exp::jsonLengthViaSqlite('[1,2,3,4]', ''));
        $this->assertSame(0, Exp::jsonLengthViaSqlite('[1,2,3,4]', '$[2]'));
        $this->assertSame(0, Exp::jsonLengthViaSqlite('{"one":[1,2,3]}'));
        $this->assertSame(3, Exp::jsonLengthViaSqlite('{"one":[1,2,3]}', '$.one'));
        $this->assertSame(null, Exp::jsonLengthViaSqlite('{"one":[1,2,3]}', '$.two'));
    }
}
