<?php

namespace Inilim\Tool\Test\Method\LarExp;

use Inilim\Tool\LarExp;
use Inilim\Tool\Test\TestCase;

/**
 * @group inactive
 */
class safeExplodeTest extends TestCase
{
    /**
     * @param  array{0: string, 1: string, 2?: int, 3?: mixed}  $input
     * @param  list<string|null>  $expected
     * @dataProvider data
     */
    function test(array $input, array $expected)
    {
        $this->assertEquals($expected, LarExp::safeExplode(...$input));
    }

    /**
     * @return array{array{0: string, 1: string, 2?: int, 3?: mixed}, list<string|null>}
     */
    static function data(): array
    {
        return [
            'no padding needed, use defaults' => [['foo:bar', ':'], ['foo', 'bar']],
            'no padding needed, explicit values' => [['foo:bar', ':', 2, null], ['foo', 'bar']],
            'one entry needs to be passed, null padding given' => [['foo', ':', 2, null], ['foo', null]],
            'limit set to 1, only one entry returned' => [['foo:bar', ':', 1], ['foo:bar']],
            'limit set to 0, treated the same as with 1' => [['foo:bar', ':', 0], ['foo:bar']],
            'negative limit given, correctly exploded from end of array, no padding needed' => [['foo:bar:baz', ':', -1], ['foo', 'bar']],
            'negative limit given, correctly exploded from end of array, both resulting entries correctly padded with null' => [['foo:bar', ':', -2, null], [null, null]],
        ];
    }
}
