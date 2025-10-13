<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;

/**
 */
class str_decrementTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider strDecrementProvider
     */
    function testStrDecrement(string $result, string $string)
    {
        $this->assertSame($result, PF::str_decrement($string));
    }

    /**
     * @dataProvider strInvalidDecrementProvider
     */
    function testInvalidStrDecrement(string $errorMessage, string $string)
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessage($errorMessage);

        PF::str_decrement($string);
    }

    static function strDecrementProvider(): iterable
    {
        yield ['Ay', 'Az'];
        yield ['aY', 'aZ'];
        yield ['A8', 'A9'];
        yield ['a8', 'a9'];
        yield ['Yz', 'Za'];
        yield ['yZ', 'zA'];
        yield ['Y9', 'Z0'];
        yield ['y9', 'z0'];
        yield ['Z', 'aA'];
        yield ['9', 'A0'];
        yield ['9', 'a0'];
        yield ['9', '10'];
        yield ['Z', '1A'];
        yield ['z', '1a'];
        yield ['9z', '10a'];
        yield ['5e5', '5e6'];
        yield ['C', 'D'];
        yield ['c', 'd'];
        yield ['3', '4'];
    }

    static function strInvalidDecrementProvider(): iterable
    {
        yield ['PF::str_decrement(): Argument #1 ($string)', ''];
        yield ['PF::str_decrement(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', '我喜歡雞肉'];
        yield ['PF::str_decrement(): Argument #1 ($string) "0" is out of decrement range', '0'];
        yield ['PF::str_decrement(): Argument #1 ($string) "a" is out of decrement range', 'a'];
        yield ['PF::str_decrement(): Argument #1 ($string) "A" is out of decrement range', 'A'];
        yield ['PF::str_decrement(): Argument #1 ($string) "00" is out of decrement range', '00'];
        yield ['PF::str_decrement(): Argument #1 ($string) "0a" is out of decrement range', '0a'];
        yield ['PF::str_decrement(): Argument #1 ($string) "0A" is out of decrement range', '0A'];
    }
}
