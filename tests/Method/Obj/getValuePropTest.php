<?php

namespace Inilim\Tool\Test\Method\Obj;

use Inilim\Tool\Obj;
use Inilim\Tool\Test\ForTest\ClassicClass;

class getValuePropTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider data
     */
    function test($prop)
    {
        $this->assertNull(Obj::getValueProp($prop, new ClassicClass, 'AAA'));
    }

    function testExceptionUndefineProp()
    {
        $this->expectException(\Exception::class);
        $this->assertNull(Obj::getValueProp('dwawdw', new ClassicClass, 'AAA', true));
    }

    static function data()
    {
        return [
            ['privatePropNonType'],
            ['protectedPropNonType'],
            ['publicPropNonType'],
            ['publicStaticPropNonType'],
            ['protectedStaticPropNonType'],
            ['privateStaticPropNonType'],
        ];
    }
}
