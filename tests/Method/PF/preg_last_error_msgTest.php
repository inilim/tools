<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class preg_last_error_msgTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @covers \Symfony\Polyfill\Php80\Php80::preg_last_error_msg
     */
    function testPregNoError()
    {
        $this->assertSame('No error', PF::preg_last_error_msg());
    }

    /**
     * @covers \Symfony\Polyfill\Php80\Php80::preg_last_error_msg
     */
    function testPregMalformedUtfError()
    {
        @preg_split('/a/u', "a\xff");
        $this->assertSame('Malformed UTF-8 characters, possibly incorrectly encoded', PF::preg_last_error_msg());
    }

    /**
     * @covers \Symfony\Polyfill\Php80\Php80::preg_last_error_msg
     */
    function testPregMalformedUtf8Offset()
    {
        @preg_match('/a/u', "\xE3\x82\xA2", $m, 0, 1);
        $this->assertSame(
            'The offset did not correspond to the beginning of a valid UTF-8 code point',
            PF::preg_last_error_msg()
        );
    }
}
