<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('inactive')]
class asciiTest extends TestCase
{
    function testStringAscii(): void
    {
        $this->assertSame('@', Str::ascii('@'));
        $this->assertSame('u', Str::ascii('ü'));
        $this->assertSame('', Str::ascii(''));
        $this->assertSame('a!2e', Str::ascii('a!2ë'));
    }

    function testStringAsciiWithSpecificLocale()
    {
        $this->assertSame('h H sht Sht a A ia yo', Str::ascii('х Х щ Щ ъ Ъ иа йо', 'bg'));
        $this->assertSame('ae oe ue Ae Oe Ue', Str::ascii('ä ö ü Ä Ö Ü', 'de'));
    }
}
