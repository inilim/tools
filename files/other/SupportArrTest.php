<?php

namespace Illuminate\Tests\Support;

use ArrayObject;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Support\MultipleItemsFoundException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

class SupportArrTest extends TestCase
{
    public function testSort()
    {
        $unsorted = [
            ['name' => 'Desk'],
            ['name' => 'Chair'],
        ];

        $expected = [
            ['name' => 'Chair'],
            ['name' => 'Desk'],
        ];

        $sorted = array_values(Arr::sort($unsorted));
        $this->assertEquals($expected, $sorted);

        // sort with closure
        $sortedWithClosure = array_values(Arr::sort($unsorted, function ($value) {
            return $value['name'];
        }));
        $this->assertEquals($expected, $sortedWithClosure);

        // sort with dot notation
        $sortedWithDotNotation = array_values(Arr::sort($unsorted, 'name'));
        $this->assertEquals($expected, $sortedWithDotNotation);
    }

    public function testSortDesc()
    {
        $unsorted = [
            ['name' => 'Chair'],
            ['name' => 'Desk'],
        ];

        $expected = [
            ['name' => 'Desk'],
            ['name' => 'Chair'],
        ];

        $sorted = array_values(Arr::sortDesc($unsorted));
        $this->assertEquals($expected, $sorted);

        // sort with closure
        $sortedWithClosure = array_values(Arr::sortDesc($unsorted, function ($value) {
            return $value['name'];
        }));
        $this->assertEquals($expected, $sortedWithClosure);

        // sort with dot notation
        $sortedWithDotNotation = array_values(Arr::sortDesc($unsorted, 'name'));
        $this->assertEquals($expected, $sortedWithDotNotation);
    }

    public function testSortByMany()
    {
        $unsorted = [
            ['name' => 'John', 'age' => 8,  'meta' => ['key' => 3]],
            ['name' => 'John', 'age' => 10, 'meta' => ['key' => 5]],
            ['name' => 'Dave', 'age' => 10, 'meta' => ['key' => 3]],
            ['name' => 'John', 'age' => 8,  'meta' => ['key' => 2]],
        ];

        // sort using keys
        $sorted = array_values(Arr::sort($unsorted, [
            'name',
            'age',
            'meta.key',
        ]));
        $this->assertEquals([
            ['name' => 'Dave', 'age' => 10, 'meta' => ['key' => 3]],
            ['name' => 'John', 'age' => 8,  'meta' => ['key' => 2]],
            ['name' => 'John', 'age' => 8,  'meta' => ['key' => 3]],
            ['name' => 'John', 'age' => 10, 'meta' => ['key' => 5]],
        ], $sorted);

        // sort with order
        $sortedWithOrder = array_values(Arr::sort($unsorted, [
            'name',
            ['age', false],
            ['meta.key', true],
        ]));
        $this->assertEquals([
            ['name' => 'Dave', 'age' => 10, 'meta' => ['key' => 3]],
            ['name' => 'John', 'age' => 10, 'meta' => ['key' => 5]],
            ['name' => 'John', 'age' => 8,  'meta' => ['key' => 2]],
            ['name' => 'John', 'age' => 8,  'meta' => ['key' => 3]],
        ], $sortedWithOrder);

        // sort using callable
        $sortedWithCallable = array_values(Arr::sort($unsorted, [
            function ($a, $b) {
                return $a['name'] <=> $b['name'];
            },
            function ($a, $b) {
                return $b['age'] <=> $a['age'];
            },
            ['meta.key', true],
        ]));
        $this->assertEquals([
            ['name' => 'Dave', 'age' => 10, 'meta' => ['key' => 3]],
            ['name' => 'John', 'age' => 10, 'meta' => ['key' => 5]],
            ['name' => 'John', 'age' => 8,  'meta' => ['key' => 2]],
            ['name' => 'John', 'age' => 8,  'meta' => ['key' => 3]],
        ], $sortedWithCallable);
    }

    public function testKeyBy()
    {
        $array = [
            ['id' => '123', 'data' => 'abc'],
            ['id' => '345', 'data' => 'def'],
            ['id' => '498', 'data' => 'hgi'],
        ];

        $this->assertEquals([
            '123' => ['id' => '123', 'data' => 'abc'],
            '345' => ['id' => '345', 'data' => 'def'],
            '498' => ['id' => '498', 'data' => 'hgi'],
        ], Arr::keyBy($array, 'id'));
    }
}
