<?php

namespace Inilim\Tool\Test\Method\Obj;

use Inilim\Tool\Obj;

class chunkIteratorTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @test
     */
    public function it_chunks_an_array_with_preserved_keys(): void
    {
        $input = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
        $size  = 2;

        $result = iterator_to_array(Obj::chunkIterator($input, $size, true));

        $expected = [
            ['a' => 1, 'b' => 2],
            ['c' => 3, 'd' => 4],
            ['e' => 5],
        ];
        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function it_chunks_an_array_without_preserved_keys(): void
    {
        $input = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
        $size  = 2;

        $result = iterator_to_array(Obj::chunkIterator($input, $size, false));

        $expected = [
            [1, 2],
            [3, 4],
            [5],
        ];
        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function it_handles_empty_iterable(): void
    {
        $result = iterator_to_array(Obj::chunkIterator([], 3, true));

        $this->assertSame([], $result);
    }

    /**
     * @test
     */
    public function it_handles_single_element(): void
    {
        $result = iterator_to_array(Obj::chunkIterator(['x' => 42], 5, true));

        $expected = [['x' => 42]];
        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function it_handles_size_equal_to_iterable_count(): void
    {
        $input = [1, 2, 3];
        $result = iterator_to_array(Obj::chunkIterator($input, 3, false));

        $expected = [[1, 2, 3]];
        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function it_handles_size_larger_than_iterable_count(): void
    {
        $input = [1, 2];
        $result = iterator_to_array(Obj::chunkIterator($input, 10, false));

        $expected = [[1, 2]];
        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function it_works_with_generator_input(): void
    {
        $generator = (function () {
            yield 'a' => 'foo';
            yield 'b' => 'bar';
            yield 'c' => 'baz';
        })();

        $result = iterator_to_array(Obj::chunkIterator($generator, 2, true));

        $expected = [
            ['a' => 'foo', 'b' => 'bar'],
            ['c' => 'baz'],
        ];
        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function it_works_with_iterator_input(): void
    {
        $iterator = new \ArrayIterator(['x', 'y', 'z']);
        $result   = iterator_to_array(Obj::chunkIterator($iterator, 2, false));

        $expected = [
            ['x', 'y'],
            ['z'],
        ];
        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function it_preserves_keys_only_when_flag_is_true(): void
    {
        $input = ['k1' => 'v1', 'k2' => 'v2'];

        $withKeys    = iterator_to_array(Obj::chunkIterator($input, 2, true));
        $withoutKeys = iterator_to_array(Obj::chunkIterator($input, 2, false));

        $this->assertSame([['k1' => 'v1', 'k2' => 'v2']], $withKeys);
        $this->assertSame([['v1', 'v2']], $withoutKeys);
    }

    /**
     * @test
     * @dataProvider invalidSizeProvider
     */
    public function it_throws_exception_for_non_positive_size(int $size): void
    {
        $this->expectException(\InvalidArgumentException::class); // или другой тип, если positiveInteger выбрасывает что-то иное
        iterator_to_array(Obj::chunkIterator([1, 2], $size));
    }

    public static function invalidSizeProvider(): array
    {
        return [
            'zero'      => [0],
            'negative'  => [-1],
        ];
    }

    /**
     * @test
     */
    public function it_does_not_throw_for_positive_integer(): void
    {
        $result = iterator_to_array(Obj::chunkIterator([1, 2], 1));
        $this->assertCount(2, $result);
    }
}
