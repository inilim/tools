<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class strDecrementTest extends TestCase
{
    /**
     * @dataProvider strDecrementProvider
     */
    function testStrDecrement(string $result, string $string)
    {
        $this->assertSame($result, Integer::strDecrement($string));
    }

    /**
     * @dataProvider strInvalidDecrementProvider
     */
    function testInvalidStrDecrement(string $errorMessage, string $string)
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessage($errorMessage);

        Integer::strDecrement($string);
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
        // new
        yield ['0', '1'];
        yield ['-1', '0'];
        yield ['-2', '-1'];
        yield ['-101', '-100'];
        yield ['-1000', '-999'];
    }

    static function strInvalidDecrementProvider(): iterable
    {
        yield ['PF::str_decrement(): Argument #1 ($string)', ''];
        yield ['PF::str_decrement(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', '我喜歡雞肉'];
        // new
        // yield ['PF::str_decrement(): Argument #1 ($string) "0" is out of decrement range', '0'];
        yield ['PF::str_decrement(): Argument #1 ($string) "a" is out of decrement range', 'a'];
        yield ['PF::str_decrement(): Argument #1 ($string) "A" is out of decrement range', 'A'];
        yield ['PF::str_decrement(): Argument #1 ($string) "00" is out of decrement range', '00'];
        yield ['PF::str_decrement(): Argument #1 ($string) "0a" is out of decrement range', '0a'];
        yield ['PF::str_decrement(): Argument #1 ($string) "0A" is out of decrement range', '0A'];
    }
}
