<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class str_starts_withTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @covers \Symfony\Polyfill\Php80\Php80::str_starts_with
     */
    function test()
    {
        $testStr = 'beginningMiddleEnd';

        $this->assertTrue(PF::str_starts_with($testStr, 'beginning'));
        $this->assertTrue(PF::str_starts_with($testStr, $testStr));
        $this->assertTrue(PF::str_starts_with($testStr, ''));
        // $this->assertTrue(PF::str_starts_with($testStr, null));
        $this->assertTrue(PF::str_starts_with('', ''));
        // $this->assertTrue(PF::str_starts_with(null, ''));
        $this->assertTrue(PF::str_starts_with("\x00", ''));
        $this->assertTrue(PF::str_starts_with("\x00", "\x00"));
        $this->assertTrue(PF::str_starts_with("\x00a", "\x00"));
        $this->assertTrue(PF::str_starts_with("a\x00bc", "a\x00b"));

        $this->assertFalse(PF::str_starts_with($testStr, 'Beginning'));
        $this->assertFalse(PF::str_starts_with($testStr, 'eginning'));
        $this->assertFalse(PF::str_starts_with($testStr, $testStr . $testStr));
        $this->assertFalse(PF::str_starts_with('', ' '));
        $this->assertFalse(PF::str_starts_with($testStr, "\x00"));
        $this->assertFalse(PF::str_starts_with("a\x00b", "a\x00d"));
        $this->assertFalse(PF::str_starts_with("a\x00b", "z\x00b"));
        $this->assertFalse(PF::str_starts_with('a', "a\x00"));
        $this->assertFalse(PF::str_starts_with('a', "\x00a"));

        // අයේෂ් = අ + ය + "ේ" + ෂ + ්
        // අයේෂ් = (0xe0 0xb6 0x85) + (0xe0 0xb6 0xba) + (0xe0 0xb7 0x9a) + (0xe0 0xb7 0x82) + (0xe0 0xb7 0x8a)
        $testMultiByte = 'අයේෂ්'; // 0xe0 0xb6 0x85 0xe0 0xb6 0xba 0xe0 0xb7 0x9a 0xe0 0xb7 0x82 0xe0 0xb7 0x8a
        $this->assertTrue(PF::str_starts_with($testMultiByte, 'අයේ')); // 0xe0 0xb6 0x85 0xe0 0xb6 0xba 0xe0 0xb7 0x9a
        $this->assertTrue(PF::str_starts_with($testMultiByte, 'අය')); // 0xe0 0xb6 0x85 0xe0 0xb6 0xba
        $this->assertFalse(PF::str_starts_with($testMultiByte, 'ය')); // 0xe0 0xb6 0xba
        $this->assertFalse(PF::str_starts_with($testMultiByte, 'අේ')); // 0xe0 0xb6 0x85 0xe0 0xb7 0x9a

        $testEmoji = '🙌🎉✨🚀'; // 0xf0 0x9f 0x99 0x8c 0xf0 0x9f 0x8e 0x89 0xe2 0x9c 0xa8 0xf0 0x9f 0x9a 0x80
        $this->assertTrue(PF::str_starts_with($testEmoji, '🙌')); // 0xf0 0x9f 0x99 0x8c
        $this->assertFalse(PF::str_starts_with($testEmoji, '✨')); // 0xe2 0x9c 0xa8
    }
}
