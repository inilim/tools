<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class splitIntoChunksTest extends TestCase
{
    /**
     * @test
     */
    public function emptyArrayReturnsEmpty(): void
    {
        $this->assertSame([], Arr::splitIntoChunks([], 3));
    }

    /**
     * @test
     */
    public function invalidChunksReturnsEmpty(): void
    {
        $this->assertSame([], Arr::splitIntoChunks([1, 2, 3], 0));
        $this->assertSame([], Arr::splitIntoChunks([1, 2, 3], -1));
    }

    /**
     * @test
     */
    public function basicDistributionWithoutPreserveKeys(): void
    {
        $input = ['a', 'b', 'c', 'd', 'e'];
        $expected = [
            ['a', 'd'], // 0,3
            ['b', 'e'], // 1,4
            ['c'],      // 2
        ];

        $this->assertSame($expected, Arr::splitIntoChunks($input, 3));
    }

    /**
     * @test
     */
    public function distributionWithPreserveKeys(): void
    {
        $input = ['a', 'b', 'c', 'd', 'e'];
        $expected = [
            [0 => 'a', 3 => 'd'],
            [1 => 'b', 4 => 'e'],
            [2 => 'c'],
        ];

        $this->assertSame($expected, Arr::splitIntoChunks($input, 3, true));
    }

    /**
     * @test
     */
    public function removeEmptyChunksFalse(): void
    {
        $input = ['x', 'y'];
        // 3 чанка, два заполнены, один пустой
        $expected = [
            ['x'],
            ['y'],
            [],
        ];

        $this->assertSame($expected, Arr::splitIntoChunks($input, 3, false, false));
    }

    /**
     * @test
     */
    public function removeEmptyChunksTrue(): void
    {
        $input = ['x', 'y'];
        // пустой чанк должен быть удалён
        $expected = [
            ['x'],
            ['y'],
        ];

        $this->assertSame($expected, Arr::splitIntoChunks($input, 3, false, true));
    }

    /**
     * @test
     */
    public function preserveKeysWithStringKeys(): void
    {
        $input = ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4];
        $expected = [
            ['one' => 1, 'four' => 4],
            ['two' => 2],
            ['three' => 3],
        ];

        $this->assertSame($expected, Arr::splitIntoChunks($input, 3, true));
    }

    /**
     * @test
     */
    public function chunksLargerThanArrayLength(): void
    {
        $input = [10, 20];
        // 5 чанков: первые два получат элементы, остальные пустые
        $expected = [
            [10],
            [20],
            [],
            [],
            [],
        ];

        $this->assertSame($expected, Arr::splitIntoChunks($input, 5, false, false));

        // С удалением пустых
        $expectedWithoutEmpty = [
            [10],
            [20],
        ];
        $this->assertSame($expectedWithoutEmpty, Arr::splitIntoChunks($input, 5, false, true));
    }

    /**
     * @test
     */
    public function chunksEqualOne(): void
    {
        $input = [1, 2, 3, 4];
        $expected = [
            [1, 2, 3, 4],
        ];

        $this->assertSame($expected, Arr::splitIntoChunks($input, 1));
    }

    /**
     * @test
     */
    public function chunksExactFit(): void
    {
        $input = [1, 2, 3, 4, 5, 6];
        $expected = [
            [1, 4],
            [2, 5],
            [3, 6],
        ];

        $this->assertSame($expected, Arr::splitIntoChunks($input, 3));
    }

    /**
     * @test
     */
    public function removeEmptyChunksRemovesAllEmpty(): void
    {
        // Если массив пуст, результат пуст – это уже проверено.
        // Проверяем, что при removeEmptyChunks = true и все чанки пусты (массив пуст) – пустой массив.
        $this->assertSame([], Arr::splitIntoChunks([], 3, false, true));
    }
}
