<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\PF;
use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class resetKeysRecursiveTest extends TestCase
{
    /**
     * @test
     */
    public function emptyArray(): void
    {
        $this->assertSame([], Arr::resetKeysRecursive([]));
    }

    /**
     * @test
     */
    public function alreadyIndexedArray(): void
    {
        $this->assertSame([1, 2, 3], Arr::resetKeysRecursive([1, 2, 3]));
    }

    /**
     * @test
     */
    public function numericKeysNotStartingFromZero(): void
    {
        $this->assertSame(
            ['a', 'b', 'c'],
            Arr::resetKeysRecursive([1 => 'a', 2 => 'b', 3 => 'c'])
        );
    }

    /**
     * @test
     */
    public function associativeArray(): void
    {
        $input = ['foo' => 'bar', 'baz' => 'qux'];
        $expected = ['bar', 'qux']; // порядок вставки сохраняется
        $this->assertSame($expected, Arr::resetKeysRecursive($input));
    }

    /**
     * @test
     */
    public function preservesOrderOfValues(): void
    {
        $input = [2 => 'x', 0 => 'y', 1 => 'z'];
        $expected = ['x', 'y', 'z']; // в порядке объявления
        $this->assertSame($expected, Arr::resetKeysRecursive($input));
    }

    /**
     * @test
     */
    public function nestedArraysAreResetRecursively(): void
    {
        $input = [
            'a' => [
                'b' => 'c',
                'd' => 'e',
            ],
            'f' => [
                5 => 'g',
                3 => 'h',
            ],
        ];
        $expected = [
            ['c', 'e'],
            ['g', 'h'],
        ];
        $this->assertSame($expected, Arr::resetKeysRecursive($input));
    }

    /**
     * @test
     */
    public function deeplyNestedStructure(): void
    {
        $input = [
            'x' => [
                'y' => [
                    'z' => 1,
                ],
            ],
        ];
        $expected = [
            [
                [1],
            ],
        ];
        $this->assertSame($expected, Arr::resetKeysRecursive($input));
    }

    /**
     * @test
     */
    public function mixedValuesWithObjects(): void
    {
        $obj = new \stdClass();
        $input = [
            'scalar' => 42,
            'obj'    => $obj,
            'arr'    => ['nested' => 'value'],
        ];
        $expected = [
            0 => 42,
            1 => $obj,
            2 => ['value'], // вложенный массив переиндексирован
        ];
        $this->assertSame($expected, Arr::resetKeysRecursive($input));
    }

    /**
     * @test
     */
    public function doesNotModifyOriginalArray(): void
    {
        $original = [
            'key1' => [1, 2],
            'key2' => 'string',
        ];
        $copy = $original;
        Arr::resetKeysRecursive($original);
        $this->assertSame($copy, $original);
    }

    /**
     * @test
     */
    public function emptyNestedArrays(): void
    {
        $input = ['a' => [], 'b' => ['c' => []]];
        $expected = [[], [[]]];
        $this->assertSame($expected, Arr::resetKeysRecursive($input));
    }
}
