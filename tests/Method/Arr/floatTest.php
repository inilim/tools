<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class floatTest extends TestCase
{
    function test()
    {
        $test_array = ['string' => 'foo bar', 'float' => 12.34];

        // Test float values are returned as floats
        $this->assertSame(
            12.34,
            Arr::float($test_array, 'float')
        );

        // Test that default float values are returned for missing keys
        $this->assertSame(
            56.78,
            Arr::float($test_array, 'missing_key', 56.78)
        );

        // Test that an exception is raised if the value is not a float
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('#^Array value for key \[string\] must be a float, (.*) found.#');
        Arr::float($test_array, 'string');
    }
}
