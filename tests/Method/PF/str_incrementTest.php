<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use Inilim\Tool\VD;

/**
 */
class str_incrementTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider strIncrementProvider
     */
    function testStrIncrement(string $result, string $string)
    {
        $this->assertSame($result, PF::str_increment($string));
    }

    /**
     * @covers \Symfony\Polyfill\Php83\Php83::str_increment
     *
     * @dataProvider strInvalidIncrementProvider
     */
    function testInvalidStrIncrement(string $errorMessage, string $string)
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessage($errorMessage);

        PF::str_increment($string);
    }

    static function strIncrementProvider(): iterable
    {
        yield ['ABD', 'ABC'];
        yield ['EB', 'EA'];
        yield ['AAA', 'ZZ'];
        yield ['Ba', 'Az'];
        yield ['bA', 'aZ'];
        yield ['B0', 'A9'];
        yield ['b0', 'a9'];
        yield ['AAa', 'Zz'];
        yield ['aaA', 'zZ'];
        yield ['10a', '9z'];
        yield ['10A', '9Z'];
        yield ['5e7', '5e6'];
        yield ['e', 'd'];
        yield ['E', 'D'];
        yield ['5', '4'];
    }

    static function strInvalidIncrementProvider(): iterable
    {
        yield ['PF::str_increment(): Argument #1 ($string)', ''];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', '-cc'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', 'Z '];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', ' Z'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', 'é'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', '我喜歡雞肉'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', 'α'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', 'ω'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', 'Α'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', 'Ω'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', 'foo1.txt'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', '1f.5'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', 'foo.1.txt'];
        yield ['PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters', '1.f.5'];
    }
}
