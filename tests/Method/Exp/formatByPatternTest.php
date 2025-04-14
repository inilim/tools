<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\Exp;
use Inilim\Tool\Test\TestCase;

class formatByPatternTest extends TestCase
{
    /**
     * @DataProvider providesFormatByPattern
     */
    function test(string $input, string $pattern, string $output)
    {
        $this->assertSame($output, Exp::formatByPattern($input, $pattern));
    }

    static function providesFormatByPattern()
    {
        return [
            'hyphenated-triplets' => ['123456789', '***-***-***', '123-456-789'],
            'slashed-triplets' => ['123456789', '***/***/***', '123/456/789'],
            'uneven-hyphenated' => ['123456789', '**-*****-**', '12-34567-89'],
            'different-delimiters' => ['123456789', '***;***,***', '123;456,789'],
            'chars-and-numbers' => ['550e8400e29b41d4a716446655440000', '********-****-****-****-************', '550e8400-e29b-41d4-a716-446655440000'],
        ];
    }
}
