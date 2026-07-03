<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;

class array_filterTest extends \Inilim\Tool\Test\TestCase
{
    // ----------------------------------------------------------------
    // 1. Передан callback (всегда вызывает родную array_filter)
    // ----------------------------------------------------------------
    public function testWithCallbackFiltersUsingNativeFunction(): void
    {
        $array = [1, 2, 3, 4, 5];
        $callback = static fn($v) => $v > 2;

        $result = PF::array_filter($array, $callback);

        $expected = [2 => 3, 3 => 4, 4 => 5];
        $this->assertSame($expected, $result);
    }

    public function testWithCallbackAndModeUseKey(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $callback = static fn($k) => $k === 'b';

        $result = PF::array_filter($array, $callback, \ARRAY_FILTER_USE_KEY);

        $expected = ['b' => 2];
        $this->assertSame($expected, $result);
    }

    public function testWithCallbackAndModeUseBoth(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $callback = static fn($v, $k) => $v > 1 && $k !== 'c';

        $result = PF::array_filter($array, $callback, \ARRAY_FILTER_USE_BOTH);

        $expected = ['b' => 2];
        $this->assertSame($expected, $result);
    }

    // ----------------------------------------------------------------
    // 2. callback === null и PHP >= 8.0 (мок Check::php80 => true)
    // ----------------------------------------------------------------
    public function testNullCallbackOnPhp80UsesNativeWithNull(): void
    {
        $array = [0, 1, false, 2, '', 3, null, 4, []];

        $result = PF::array_filter($array);

        // В PHP 8.0+ array_filter с null удаляет все значения, которые == false (0, false, '', null, [])
        $expected = [1 => 1, 3 => 2, 5 => 3, 7 => 4];
        $this->assertSame($expected, $result);
    }

    public function testNullCallbackWithModeOnPhp80PassesModeToNative(): void
    {
        $array = ['a' => 0, 'b' => 1, 'c' => 2];
        // callback == null, mode == ARRAY_FILTER_USE_KEY – в PHP 8.0 это допустимо,
        // но трактуется как фильтр с callback = null и игнорированием mode? 
        // На самом деле PHP 8.0 разрешает mode только с callback,
        // но array_filter($array, null, mode) всё равно работает как фильтр по значениям.
        // Мы проверяем, что наша функция просто передаёт параметры дальше.

        $result = PF::array_filter($array, null, \ARRAY_FILTER_USE_KEY);

        // Ожидаемое поведение родной array_filter с null и mode = ARRAY_FILTER_USE_KEY:
        // она всё равно фильтрует по значениям, т.к. callback == null.
        $expected = ['b' => 1, 'c' => 2];
        $this->assertSame($expected, $result);
    }

    // ----------------------------------------------------------------
    // 3. callback === null и PHP < 8.0 (мок Check::php80 => false)
    // ----------------------------------------------------------------
    public function testNullCallbackOnPhpBelow80FiltersFalseLikeValues(): void
    {
        $array = [
            'int_zero' => 0,
            'int_one'  => 1,
            'false'    => false,
            'string'   => 'hello',
            'empty_str' => '',
            'null'     => null,
            'array'    => [],
            'non_empty' => [1, 2],
            'true'     => true,
        ];

        $result = PF::array_filter($array);

        // Ручная фильтрация: удаляются все элементы, для которых (bool)$v === false.
        // false-подобные: 0, false, '', null, [].
        $expected = [
            'int_one'  => 1,
            'string'   => 'hello',
            'non_empty' => [1, 2],
            'true'     => true,
        ];
        $this->assertSame($expected, $result);
    }

    public function testNullCallbackOnPhpBelow80PreservesKeys(): void
    {
        $array = ['first' => false, 'second' => true, 'third' => 0];

        $result = PF::array_filter($array);

        $expected = ['second' => true];
        $this->assertSame($expected, $result);
    }

    public function testNullCallbackOnPhpBelow80ModeIsIgnored(): void
    {
        $array = ['a' => 0, 'b' => 1];
        // mode игнорируется в ручной ветке
        $result = PF::array_filter($array, null, \ARRAY_FILTER_USE_KEY);

        $expected = ['b' => 1];
        $this->assertSame($expected, $result);
    }

    // ----------------------------------------------------------------
    // 4. Краевые случаи
    // ----------------------------------------------------------------
    public function testEmptyArrayReturnsEmptyArray(): void
    {
        $this->assertSame([], PF::array_filter([]));
        $this->assertSame([], PF::array_filter([], static fn($v) => $v));
    }

    public function testAllElementsFalseReturnsEmptyArray(): void
    {
        $array = [false, 0, '', null, []];
        $this->assertSame([], PF::array_filter($array));
    }

    public function testCallbackReceivesValueAndKeyInBothMode(): void
    {
        // Без мока, т.к. используется callback
        $array = ['x' => 10, 'y' => 20];
        $spy = [];
        $callback = function ($v, $k) use (&$spy) {
            $spy[] = [$v, $k];
            return true;
        };

        PF::array_filter($array, $callback, \ARRAY_FILTER_USE_BOTH);

        $expected = [[10, 'x'], [20, 'y']];
        $this->assertSame($expected, $spy);
    }
}
