<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class integerTest extends TestCase
{
    function test()
    {
        $test_array = ['string' => 'foo bar', 'integer' => 1234];

        // Test integer values are returned as integers
        $this->assertSame(
            1234,
            Arr::integer($test_array, 'integer')
        );

        // Test that default integer values are returned for missing keys
        $this->assertSame(
            999,
            Arr::integer($test_array, 'missing_key', 999)
        );

        // Test that an exception is raised if the value is not an integer
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('#^Array value for key \[string\] must be an integer, (.*) found.#');
        Arr::integer($test_array, 'string');
    }
}
