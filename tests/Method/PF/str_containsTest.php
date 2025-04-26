<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class str_containsTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @covers \Symfony\Polyfill\Php80\Php80::str_contains
     */
    function test()
    {
        $this->assertTrue(PF::str_contains('abc', ''));
        // $this->assertTrue(PF::str_contains('abc', null));
        $this->assertTrue(PF::str_contains('abc', 'a'));
        $this->assertTrue(PF::str_contains('abc', 'bc'));
        $this->assertTrue(PF::str_contains('abc', 'abc'));
        $this->assertTrue(PF::str_contains('한국어', '국'));
        $this->assertTrue(PF::str_contains('한국어', ''));
        $this->assertTrue(PF::str_contains('', ''));
        $this->assertFalse(PF::str_contains('abc', 'd'));
        $this->assertFalse(PF::str_contains('', 'd'));
        // $this->assertFalse(PF::str_contains(null, 'd'));
        $this->assertFalse(PF::str_contains('abc', 'abcd'));
        $this->assertFalse(PF::str_contains('DÉJÀ', 'à'));
        $this->assertFalse(PF::str_contains('a', 'à'));
    }
}
