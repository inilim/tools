<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class str_ends_withTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @covers \Symfony\Polyfill\Php80\Php80::str_ends_with
     */
    function test()
    {
        $testStr = 'beginningMiddleEnd';

        $this->assertTrue(PF::str_ends_with($testStr, 'End'));
        $this->assertFalse(PF::str_ends_with($testStr, 'end'));
        $this->assertFalse(PF::str_ends_with($testStr, 'en'));
        $this->assertTrue(PF::str_ends_with($testStr, $testStr));
        $this->assertFalse(PF::str_ends_with($testStr, $testStr . $testStr));
        $this->assertTrue(PF::str_ends_with($testStr, ''));
        // $this->assertTrue(PF::str_ends_with($testStr, null));
        $this->assertTrue(PF::str_ends_with('', ''));
        // $this->assertTrue(PF::str_ends_with(null, ''));
        $this->assertFalse(PF::str_ends_with('', ' '));
        $this->assertFalse(PF::str_ends_with($testStr, "\x00"));
        $this->assertTrue(PF::str_ends_with("\x00", ''));
        $this->assertTrue(PF::str_ends_with("\x00", "\x00"));
        $this->assertTrue(PF::str_ends_with("a\x00", "\x00"));
        $this->assertTrue(PF::str_ends_with("ab\x00c", "b\x00c"));
        $this->assertFalse(PF::str_ends_with("a\x00b", "d\x00b"));
        $this->assertFalse(PF::str_ends_with("a\x00b", "a\x00z"));
        $this->assertFalse(PF::str_ends_with('a', "\x00a"));
        $this->assertFalse(PF::str_ends_with('a', "a\x00"));

        $testMultiByte = 'අයේෂ්'; // 0xe0 0xb6 0x85 0xe0 0xb6 0xba 0xe0 0xb7 0x9a 0xe0 0xb7 0x82 0xe0 0xb7 0x8a
        $this->assertTrue(PF::str_ends_with($testMultiByte, 'ෂ්')); // 0xe0 0xb7 0x82 0xe0 0xb7 0x8a
        $this->assertTrue(PF::str_ends_with($testMultiByte, '්')); // 0xe0 0xb7 0x8a
        $this->assertFalse(PF::str_ends_with($testMultiByte, 'ෂ')); // 0xe0 0xb7 0x82

        $testEmoji = '🙌🎉✨🚀'; // 0xf0 0x9f 0x99 0x8c 0xf0 0x9f 0x8e 0x89 0xe2 0x9c 0xa8 0xf0 0x9f 0x9a 0x80
        $this->assertTrue(PF::str_ends_with($testEmoji, '🚀')); // 0xf0 0x9f 0x9a 0x80
        $this->assertFalse(PF::str_ends_with($testEmoji, '✨')); // 0xe2 0x9c 0xa8

        $this->assertFalse(PF::str_ends_with('', '[]'));
    }
}
