<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class stringTest extends TestCase
{
    function test()
    {
        $test_array = ['string' => 'foo bar', 'integer' => 1234];

        // Test string values are returned as strings
        $this->assertSame(
            'foo bar',
            Arr::string($test_array, 'string')
        );

        // Test that default string values are returned for missing keys
        $this->assertSame(
            'default',
            Arr::string($test_array, 'missing_key', 'default')
        );

        // Test that an exception is raised if the value is not a string
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('#^Array value for key \[integer\] must be a string, (.*) found.#');
        Arr::string($test_array, 'integer');
    }
}
