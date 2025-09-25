<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use Inilim\Tool\VD;

/**
 */
class mb_str_padTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider paddingStringProvider
     * @dataProvider paddingEmojiProvider
     * @dataProvider paddingEncodingProvider
     */
    function testMbStrPad(string $expectedResult, string $string, int $length, string $padString, int $padType, ?string $encoding = null)
    {
        $this->assertSame($expectedResult, mb_convert_encoding(PF::mb_str_pad($string, $length, $padString, $padType, $encoding), 'UTF-8', $encoding ?? mb_internal_encoding()));
    }

    /**
     * @dataProvider mbStrPadInvalidArgumentsProvider
     */
    function testMbStrPadInvalidArguments(string $expectedError, string $string, int $length, string $padString, int $padType, ?string $encoding = null)
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessage($expectedError);

        PF::mb_str_pad($string, $length, $padString, $padType, $encoding);
    }

    static function paddingStringProvider(): iterable
    {
        // Simple ASCII strings
        yield ['+Hello+', 'Hello', 7, '+-', \STR_PAD_BOTH];
        yield ['+-World+-+', 'World', 10, '+-', \STR_PAD_BOTH];
        yield ['+-Hello', 'Hello', 7, '+-', \STR_PAD_LEFT];
        yield ['+-+-+World', 'World', 10, '+-', \STR_PAD_LEFT];
        yield ['Hello+-', 'Hello', 7, '+-', \STR_PAD_RIGHT];
        yield ['World+-+-+', 'World', 10, '+-', \STR_PAD_RIGHT];
        // Edge cases pad length
        yield ['▶▶', '▶▶', 2, ' ', \STR_PAD_BOTH];
        yield ['▶▶', '▶▶', 1, ' ', \STR_PAD_BOTH];
        yield ['▶▶', '▶▶', 0, ' ', \STR_PAD_BOTH];
        yield ['▶▶', '▶▶', -1, ' ', \STR_PAD_BOTH];
        // Empty input string
        yield ['  ', '', 2, ' ', \STR_PAD_BOTH];
        yield [' ', '', 1, ' ', \STR_PAD_BOTH];
        yield ['', '', 0, ' ', \STR_PAD_BOTH];
        yield ['', '', -1, ' ', \STR_PAD_BOTH];
        // Default argument
        yield ['▶▶    ', '▶▶', 6, ' ', \STR_PAD_RIGHT];
        yield ['    ▶▶', '▶▶', 6, ' ', \STR_PAD_LEFT];
        yield ['  ▶▶  ', '▶▶', 6, ' ', \STR_PAD_BOTH];
    }

    static function paddingEmojiProvider(): iterable
    {
        // UTF-8 Emojis
        yield ['▶▶❤❓❇❤', '▶▶', 6, '❤❓❇', \STR_PAD_RIGHT];
        yield ['❤❓❇❤▶▶', '▶▶', 6, '❤❓❇', \STR_PAD_LEFT];
        yield ['❤❓▶▶❤❓', '▶▶', 6, '❤❓❇', \STR_PAD_BOTH];
        yield ['▶▶❤❓❇', '▶▶', 5, '❤❓❇', \STR_PAD_RIGHT];
        yield ['❤❓❇▶▶', '▶▶', 5, '❤❓❇', \STR_PAD_LEFT];
        yield ['❤▶▶❤❓', '▶▶', 5, '❤❓❇', \STR_PAD_BOTH];
        yield ['▶▶❤❓', '▶▶', 4, '❤❓❇', \STR_PAD_RIGHT];
        yield ['❤❓▶▶', '▶▶', 4, '❤❓❇', \STR_PAD_LEFT];
        yield ['❤▶▶❤', '▶▶', 4, '❤❓❇', \STR_PAD_BOTH];
        yield ['▶▶❤', '▶▶', 3, '❤❓❇', \STR_PAD_RIGHT];
        yield ['❤▶▶', '▶▶', 3, '❤❓❇', \STR_PAD_LEFT];
        yield ['▶▶❤', '▶▶', 3, '❤❓❇', \STR_PAD_BOTH];

        for ($i = 2; $i >= 0; --$i) {
            yield ['▶▶', '▶▶', $i, '❤❓❇', \STR_PAD_RIGHT];
            yield ['▶▶', '▶▶', $i, '❤❓❇', \STR_PAD_LEFT];
            yield ['▶▶', '▶▶', $i, '❤❓❇', \STR_PAD_BOTH];
        }
    }

    static function paddingEncodingProvider(): iterable
    {
        $string = 'Σὲ γνωρίζω ἀπὸ τὴν κόψη Зарегистрируйтесь';

        foreach (['UTF-8', 'UTF-32', 'UTF-7'] as $encoding) {
            $input = mb_convert_encoding($string, $encoding, 'UTF-8');
            $padStr = mb_convert_encoding('▶▶', $encoding, 'UTF-8');

            yield ['Σὲ γνωρίζω ἀπὸ τὴν κόψη Зарегистрируйтесь▶▶▶', $input, 44, $padStr, \STR_PAD_RIGHT, $encoding];
            yield ['▶▶▶Σὲ γνωρίζω ἀπὸ τὴν κόψη Зарегистрируйтесь', $input, 44, $padStr, \STR_PAD_LEFT, $encoding];
            yield ['▶Σὲ γνωρίζω ἀπὸ τὴν κόψη Зарегистрируйтесь▶▶', $input, 44, $padStr, \STR_PAD_BOTH, $encoding];
        }
    }

    static function mbStrPadInvalidArgumentsProvider(): iterable
    {
        yield ['PF::mb_str_pad(): Argument #3 ($pad_string)', '▶▶', 6, '', \STR_PAD_RIGHT];
        yield ['PF::mb_str_pad(): Argument #3 ($pad_string)', '▶▶', 6, '', \STR_PAD_LEFT];
        yield ['PF::mb_str_pad(): Argument #3 ($pad_string)', '▶▶', 6, '', \STR_PAD_BOTH];
        yield ['PF::mb_str_pad(): Argument #4 ($pad_type) must be STR_PAD_LEFT, STR_PAD_RIGHT, or STR_PAD_BOTH', '▶▶', 6, ' ', 123456];
        yield ['PF::mb_str_pad(): Argument #5 ($encoding) must be a valid encoding, "unexisting" given', '▶▶', 6, ' ', \STR_PAD_BOTH, 'unexisting'];
    }
}
