<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\Exp;
use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;

/**
 * TODO нужно еще тесты
 */
class jsonExtractViaSqliteTest extends TestCase
{
    function test()
    {
        // json_extract('{"a":2,"c":[4,5,{"f":7}]}', '$') → '{"a":2,"c":[4,5,{"f":7}]}'
        // json_extract('{"a":2,"c":[4,5,{"f":7}]}', '$.c') → '[4,5,{"f":7}]'
        // json_extract('{"a":2,"c":[4,5,{"f":7}]}', '$.c[2]') → '{"f":7}'
        // json_extract('{"a":2,"c":[4,5,{"f":7}]}', '$.c[2].f') → 7
        // json_extract('{"a":2,"c":[4,5],"f":7}','$.c','$.a') → '[[4,5],2]'
        // json_extract('{"a":2,"c":[4,5],"f":7}','$.c[#-1]') → 5
        // json_extract('{"a":2,"c":[4,5,{"f":7}]}', '$.x') → NULL
        // json_extract('{"a":2,"c":[4,5,{"f":7}]}', '$.x', '$.a') → '[null,2]'
        // json_extract('{"a":"xyz"}', '$.a') → 'xyz'
        // json_extract('{"a":null}', '$.a') → NULL

        $this->assertSame('{"a":2,"c":[4,5,{"f":7}]}', Exp::jsonExtractViaSqlite('{"a":2,"c":[4,5,{"f":7}]}', '$'));
        $this->assertSame('[4,5,{"f":7}]', Exp::jsonExtractViaSqlite('{"a":2,"c":[4,5,{"f":7}]}', '$.c'));
        $this->assertSame('{"f":7}', Exp::jsonExtractViaSqlite('{"a":2,"c":[4,5,{"f":7}]}', '$.c[2]'));
        $this->assertSame('7', Exp::jsonExtractViaSqlite('{"a":2,"c":[4,5,{"f":7}]}', '$.c[2].f'));
        $this->assertSame('[[4,5],2]', Exp::jsonExtractViaSqlite('{"a":2,"c":[4,5],"f":7}', ['$.c', '$.a']));
        $this->assertSame('5', Exp::jsonExtractViaSqlite('{"a":2,"c":[4,5],"f":7}', '$.c[#-1]'));
        $this->assertSame(null, Exp::jsonExtractViaSqlite('{"a":2,"c":[4,5,{"f":7}]}', '$.x'));
        $this->assertSame('[null,2]', Exp::jsonExtractViaSqlite('{"a":2,"c":[4,5,{"f":7}]}', ['$.x', '$.a']));
        $this->assertSame('xyz', Exp::jsonExtractViaSqlite('{"a":"xyz"}', '$.a'));
        $this->assertSame(null, Exp::jsonExtractViaSqlite('{"a":null}', '$.a'));
    }

    function testInvalidJson()
    {
        Other::errorClearLast();
        $this->assertSame(null, Exp::jsonExtractViaSqlite('"a":null}', '$.a'));
        $this->assertSame(true, \is_array(Other::errorGetLast()));
    }
}
