<?php

namespace Inilim\Tool\Test\Method\Obj;

use Inilim\Tool\Obj;

/**
 * 
 */
class peekBackIteratorTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideIterables
     */
    function testPeekBackIterator(iterable $input, array $expected): void
    {
        $generator = Obj::peekBackIterator($input);
        $result = \iterator_to_array($generator, true);

        $this->assertSame($expected, $result);
    }

    static function provideIterables(): array
    {
        return [
            'empty array' => [
                'input' => [],
                'expected' => [],
            ],
            'single element array (indexed)' => [
                'input' => ['a'],
                'expected' => [
                    0 => ['before' => null, 'current' => 'a', 'after' => null],
                ],
            ],
            'two elements array (indexed)' => [
                'input' => ['a', 'b'],
                'expected' => [
                    0 => ['before' => null, 'current' => 'a', 'after' => 'b'],
                    1 => ['before' => 'a', 'current' => 'b', 'after' => null],
                ],
            ],
            'three elements array (indexed)' => [
                'input' => ['a', 'b', 'c'],
                'expected' => [
                    0 => ['before' => null, 'current' => 'a', 'after' => 'b'],
                    1 => ['before' => 'a', 'current' => 'b', 'after' => 'c'],
                    2 => ['before' => 'b', 'current' => 'c', 'after' => null],
                ],
            ],
            'associative array' => [
                'input' => ['x' => 1, 'y' => 2, 'z' => 3],
                'expected' => [
                    'x' => ['before' => null, 'current' => 1, 'after' => 2],
                    'y' => ['before' => 1, 'current' => 2, 'after' => 3],
                    'z' => ['before' => 2, 'current' => 3, 'after' => null],
                ],
            ],
            'ArrayIterator' => [
                'input' => new \ArrayIterator(['apple', 'banana', 'cherry']),
                'expected' => [
                    0 => ['before' => null, 'current' => 'apple', 'after' => 'banana'],
                    1 => ['before' => 'apple', 'current' => 'banana', 'after' => 'cherry'],
                    2 => ['before' => 'banana', 'current' => 'cherry', 'after' => null],
                ],
            ],
            'Generator (yield)' => [
                'input' => (static function (): \Generator {
                    yield 10;
                    yield 20;
                    yield 30;
                })(),
                'expected' => [
                    0 => ['before' => null, 'current' => 10, 'after' => 20],
                    1 => ['before' => 10, 'current' => 20, 'after' => 30],
                    2 => ['before' => 20, 'current' => 30, 'after' => null],
                ],
            ],
            'mixed types' => [
                'input' => [null, false, 42, 'string'],
                'expected' => [
                    0 => ['before' => null, 'current' => null, 'after' => false],
                    1 => ['before' => null, 'current' => false, 'after' => 42],
                    2 => ['before' => false, 'current' => 42, 'after' => 'string'],
                    3 => ['before' => 42, 'current' => 'string', 'after' => null],
                ],
            ],
        ];
    }

    /**
     * Проверка сохранения ключей, включая строковые и нечисловые.
     */
    function testPreservesKeys(): void
    {
        $input = [
            'first' => 100,
            'second' => 200,
            'third' => 300,
        ];
        $generator = Obj::peekBackIterator($input);
        $result = \iterator_to_array($generator, true);

        $this->assertArrayHasKey('first', $result);
        $this->assertArrayHasKey('second', $result);
        $this->assertArrayHasKey('third', $result);
        $this->assertSame([
            'before' => null,
            'current' => 100,
            'after' => 200,
        ], $result['first']);
        $this->assertSame([
            'before' => 100,
            'current' => 200,
            'after' => 300,
        ], $result['second']);
        $this->assertSame([
            'before' => 200,
            'current' => 300,
            'after' => null,
        ], $result['third']);
    }

    /**
     * Проверка, что функция корректно обрабатывает итератор с одним элементом.
     */
    function testSingleElementGenerator(): void
    {
        $generator = Obj::peekBackIterator(['only']);
        $result = \iterator_to_array($generator, true);
        $this->assertCount(1, $result);
        $this->assertSame([
            'before' => null,
            'current' => 'only',
            'after' => null,
        ], $result[0]);
    }

    /**
     * Проверка, что возвращается именно генератор (экземпляр Generator).
     */
    function testReturnsGenerator(): void
    {
        $result = Obj::peekBackIterator([]);
        $this->assertInstanceOf(\Generator::class, $result);
    }
}
