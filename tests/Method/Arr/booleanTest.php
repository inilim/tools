<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class booleanTest extends TestCase
{
    function test()
    {
        $test_array = ['string' => 'foo bar',  'boolean' => true];

        // Test boolean values are returned as booleans
        $this->assertSame(
            true,
            Arr::boolean($test_array, 'boolean')
        );

        // Test that default boolean values are returned for missing keys
        $this->assertSame(
            true,
            Arr::boolean($test_array, 'missing_key', true)
        );

        // Test that an exception is raised if the value is not a boolean
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('#^Array value for key \[string\] must be a boolean, (.*) found.#');
        Arr::boolean($test_array, 'string');
    }
}
