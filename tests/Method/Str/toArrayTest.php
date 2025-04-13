<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class toArrayTest extends TestCase
{
    function testToArrayWithCommaSeparator()
    {
        $this->assertEquals(
            ['1', '2', '3'],
            Str::toArray('1,2,3')
        );
    }

    function testToArrayWithDashSeparator()
    {
        $this->assertEquals(
            ['10', '20', '30'],
            Str::toArray('10-20-30')
        );
    }

    function testToArrayWithPipeSeparator()
    {
        $this->assertEquals(
            ['a', 'b', 'c'],
            Str::toArray('a|b|c')
        );
    }

    function testToArrayWithSlashSeparator()
    {
        $this->assertEquals(
            ['apple', 'banana', 'cherry'],
            Str::toArray('apple/banana/cherry')
        );
    }

    function testToArrayWithCustomSeparators()
    {
        $this->assertEquals(
            ['1', '2', '3'],
            Str::toArray('1*2*3', ['*'])
        );
    }

    function testToArrayWithNoSeparatorReturnsSingleElementArray()
    {
        $this->assertEquals(
            ['single'],
            Str::toArray('single')
        );
    }

    function testToArrayWithEmptyStringReturnsEmptyStringArray()
    {
        $this->assertEquals(
            [],
            Str::toArray('')
        );
    }
}
