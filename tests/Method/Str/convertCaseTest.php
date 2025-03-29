<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class convertCaseTest extends TestCase
{
    function test()
    { // Upper Case Conversion
        $this->assertSame('HELLO', Str::convertCase('hello', MB_CASE_UPPER));
        $this->assertSame('WORLD', Str::convertCase('WORLD', MB_CASE_UPPER));

        // Lower Case Conversion
        $this->assertSame('hello', Str::convertCase('HELLO', MB_CASE_LOWER));
        $this->assertSame('world', Str::convertCase('WORLD', MB_CASE_LOWER));

        // Case Folding
        $this->assertSame('hello', Str::convertCase('HeLLo', MB_CASE_FOLD));
        $this->assertSame('world', Str::convertCase('WoRLD', MB_CASE_FOLD));

        // Multi-byte String
        $this->assertSame('ÜÖÄ', Str::convertCase('üöä', MB_CASE_UPPER, 'UTF-8'));
        $this->assertSame('üöä', Str::convertCase('ÜÖÄ', MB_CASE_LOWER, 'UTF-8'));

        // Unsupported Mode
        $this->expectException(\ValueError::class);
        Str::convertCase('Hello', -1);
    }
}
