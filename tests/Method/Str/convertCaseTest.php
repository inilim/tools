<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\PF;
use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class convertCaseTest extends TestCase
{
    function test()
    { // Upper Case Conversion
        $this->assertSame('HELLO', Str::convertCase('hello', PF::MB_CASE_UPPER));
        $this->assertSame('WORLD', Str::convertCase('WORLD', PF::MB_CASE_UPPER));

        // Lower Case Conversion
        $this->assertSame('hello', Str::convertCase('HELLO', PF::MB_CASE_LOWER));
        $this->assertSame('world', Str::convertCase('WORLD', PF::MB_CASE_LOWER));

        // Case Folding
        $this->assertSame('hello', Str::convertCase('HeLLo', PF::MB_CASE_FOLD));
        $this->assertSame('world', Str::convertCase('WoRLD', PF::MB_CASE_FOLD));

        // Multi-byte String
        $this->assertSame('ÜÖÄ', Str::convertCase('üöä', PF::MB_CASE_UPPER, 'UTF-8'));
        $this->assertSame('üöä', Str::convertCase('ÜÖÄ', PF::MB_CASE_LOWER, 'UTF-8'));

        // Unsupported Mode
        // $this->expectException(\Exception::class);
        // Str::convertCase('Hello', -1);
    }
}
