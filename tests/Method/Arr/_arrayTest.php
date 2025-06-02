<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class _arrayTest extends TestCase
{
    function test()
    {
        $test_array = ['string' => 'foo bar', 'array' => ['foo', 'bar']];

        // Test array values are returned as arrays
        $this->assertSame(
            ['foo', 'bar'],
            Arr::_array($test_array, 'array')
        );

        // Test that default array values are returned for missing keys
        $this->assertSame(
            [1, 'two'],
            Arr::_array($test_array, 'missing_key', [1, 'two'])
        );

        // Test that an exception is raised if the value is not an array
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('#^Array value for key \[string\] must be an array, (.*) found.#');
        Arr::_array($test_array, 'string');
    }
}
