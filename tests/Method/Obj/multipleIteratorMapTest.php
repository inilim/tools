<?php

namespace Inilim\Tool\Test\Method\Obj;

use Inilim\Tool\Obj;

class multipleIteratorMapTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * Тест базового поведения с одним массивом.
     */
    function testSingleArray(): void
    {
        $input = [1, 2, 3];
        $result = iterator_to_array(Obj::multipleIteratorMap($input));

        $expected = [
            [1],
            [2],
            [3],
        ];
        $this->assertEquals($expected, $result);
    }

    /**
     * Тест с несколькими массивами одинаковой длины.
     */
    function testMultipleArraysSameLength(): void
    {
        $result = iterator_to_array(Obj::multipleIteratorMap([1, 2], ['a', 'b']));

        $expected = [
            [1, 'a'],
            [2, 'b'],
        ];
        $this->assertEquals($expected, $result);
    }

    /**
     * Тест с массивами разной длины (работает MIT_NEED_ANY).
     */
    function testMultipleArraysDifferentLength(): void
    {
        $result = iterator_to_array(Obj::multipleIteratorMap([1, 2, 3], ['a', 'b']));

        $expected = [
            [1, 'a'],
            [2, 'b'],
            [3, null],
        ];
        $this->assertEquals($expected, $result);

        $result = iterator_to_array(Obj::multipleIteratorMap([1, 2], ['a', 'b', 'c']));

        $expected = [
            [1, 'a'],
            [2, 'b'],
            [null, 'c'],
        ];
        $this->assertEquals($expected, $result);
    }

    /**
     * Тест, что функция возвращает именно Generator.
     */
    function testReturnsGenerator(): void
    {
        $generator = Obj::multipleIteratorMap([1]);
        $this->assertInstanceOf(\Generator::class, $generator);
    }

    /**
     * Тест с пустым массивом — не должно быть итераций.
     */
    function testEmptyArrayYieldsNothing(): void
    {
        $result = iterator_to_array(Obj::multipleIteratorMap([]));
        $this->assertCount(0, $result);
    }

    /**
     * Тест с несколькими пустыми итераторами.
     */
    function testMultipleEmptyIterables(): void
    {
        $result = iterator_to_array(Obj::multipleIteratorMap([], []));
        $this->assertCount(0, $result);
    }

    /**
     * Тест без аргументов — также не должно быть итераций.
     */
    function testNoArguments(): void
    {
        $result = iterator_to_array(Obj::multipleIteratorMap());
        $this->assertCount(0, $result);
    }

    /**
     * Тест, что для массивов создаётся ArrayIterator, а для других iterable — нет.
     */
    function testNonArrayIterablePassedDirectly(): void
    {
        // Используем ArrayIterator, который уже является итератором
        $it = new \ArrayIterator([10, 20]);
        $generator = Obj::multipleIteratorMap($it);
        $result = iterator_to_array($generator);

        $expected = [
            [10],
            [20],
        ];
        $this->assertEquals($expected, $result);
    }

    /**
     * Тест с генератором в качестве одного из iterable.
     */
    function testGeneratorAsIterable(): void
    {
        $gen = (function () {
            yield 'x';
            yield 'y';
            yield 'z';
        })();

        $result = iterator_to_array(Obj::multipleIteratorMap([1, 2, 3], $gen));

        $expected = [
            [1, 'x'],
            [2, 'y'],
            [3, 'z'],
        ];
        $this->assertEquals($expected, $result);
    }

    /**
     * Исключение если один и тотже обьект итератора
     */
    function testDoubleIterator(): void
    {
        $gen = (function () {
            yield 'x';
        })();

        $this->expectException(\InvalidArgumentException::class);
        iterator_to_array(Obj::multipleIteratorMap($gen, $gen));
    }

    /**
     * Тест, что ключи результата всегда числовые (MIT_KEYS_NUMERIC), 
     * даже если исходные массивы имеют строковые ключи.
     */
    function testAssociativeKeysAreConvertedToNumeric(): void
    {
        $arr1 = ['foo' => 'apple', 'bar' => 'banana'];
        $arr2 = ['a' => 1, 'b' => 2];

        $result = iterator_to_array(Obj::multipleIteratorMap($arr1, $arr2));

        // Ключи должны быть 0, 1, а не 'foo', 'a' и т.д.
        $expected = [
            ['apple', 1],
            ['banana', 2],
        ];
        $this->assertEquals($expected, $result);
    }

    /**
     * Тест комбинации: первый итератор длиннее, второй короче, третий пустой.
     * Ожидаем null для исчерпанных итераторов.
     */
    function testMixedLengthWithEmpty(): void
    {
        $result = iterator_to_array(Obj::multipleIteratorMap(
            [1, 2, 3],
            ['a'],
            []
        ));

        $expected = [
            [1, 'a', null],
            [2, null, null],
            [3, null, null],
        ];
        $this->assertEquals($expected, $result);
    }

    /**
     * Тест с одним генератором, который выбрасывает исключение — проверяем проброс.
     */
    function testGeneratorThrowsException(): void
    {
        $gen = (function () {
            yield 1;
            throw new \RuntimeException('test exception');
        })();

        $generator = Obj::multipleIteratorMap($gen);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('test exception');

        // Итерируем до исключения
        foreach ($generator as $item) {
            // Первый элемент нормальный
        }
    }
}
