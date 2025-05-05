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
    public function testHasAnyMethod()
    {
        $array = ['name' => 'Taylor', 'age' => '', 'city' => null];
        $this->assertTrue(Arr::hasAny($array, 'name'));
        $this->assertTrue(Arr::hasAny($array, 'age'));
        $this->assertTrue(Arr::hasAny($array, 'city'));
        $this->assertFalse(Arr::hasAny($array, 'foo'));
        $this->assertTrue(Arr::hasAny($array, 'name', 'email'));
        $this->assertTrue(Arr::hasAny($array, ['name', 'email']));

        $array = ['name' => 'Taylor', 'email' => 'foo'];
        $this->assertTrue(Arr::hasAny($array, 'name', 'email'));
        $this->assertFalse(Arr::hasAny($array, 'surname', 'password'));
        $this->assertFalse(Arr::hasAny($array, ['surname', 'password']));

        $array = ['foo' => ['bar' => null, 'baz' => '']];
        $this->assertTrue(Arr::hasAny($array, 'foo.bar'));
        $this->assertTrue(Arr::hasAny($array, 'foo.baz'));
        $this->assertFalse(Arr::hasAny($array, 'foo.bax'));
        $this->assertTrue(Arr::hasAny($array, ['foo.bax', 'foo.baz']));
    }

    public function testIsAssoc()
    {
        $this->assertTrue(Arr::isAssoc(['a' => 'a', 0 => 'b']));
        $this->assertTrue(Arr::isAssoc([1 => 'a', 0 => 'b']));
        $this->assertTrue(Arr::isAssoc([1 => 'a', 2 => 'b']));
        $this->assertFalse(Arr::isAssoc([0 => 'a', 1 => 'b']));
        $this->assertFalse(Arr::isAssoc(['a', 'b']));

        $this->assertFalse(Arr::isAssoc([]));
        $this->assertFalse(Arr::isAssoc([1, 2, 3]));
        $this->assertFalse(Arr::isAssoc(['foo', 2, 3]));
        $this->assertFalse(Arr::isAssoc([0 => 'foo', 'bar']));

        $this->assertTrue(Arr::isAssoc([1 => 'foo', 'bar']));
        $this->assertTrue(Arr::isAssoc([0 => 'foo', 'bar' => 'baz']));
        $this->assertTrue(Arr::isAssoc([0 => 'foo', 2 => 'bar']));
        $this->assertTrue(Arr::isAssoc(['foo' => 'bar', 'baz' => 'qux']));
    }

    public function testIsList()
    {
        $this->assertTrue(Arr::isList([]));
        $this->assertTrue(Arr::isList([1, 2, 3]));
        $this->assertTrue(Arr::isList(['foo', 2, 3]));
        $this->assertTrue(Arr::isList(['foo', 'bar']));
        $this->assertTrue(Arr::isList([0 => 'foo', 'bar']));
        $this->assertTrue(Arr::isList([0 => 'foo', 1 => 'bar']));

        $this->assertFalse(Arr::isList([-1 => 1]));
        $this->assertFalse(Arr::isList([-1 => 1, 0 => 2]));
        $this->assertFalse(Arr::isList([1 => 'foo', 'bar']));
        $this->assertFalse(Arr::isList([1 => 'foo', 0 => 'bar']));
        $this->assertFalse(Arr::isList([0 => 'foo', 'bar' => 'baz']));
        $this->assertFalse(Arr::isList([0 => 'foo', 2 => 'bar']));
        $this->assertFalse(Arr::isList(['foo' => 'bar', 'baz' => 'qux']));
    }

    public function testPluck()
    {
        $data = [
            'post-1' => [
                'comments' => [
                    'tags' => [
                        '#foo',
                        '#bar',
                    ],
                ],
            ],
            'post-2' => [
                'comments' => [
                    'tags' => [
                        '#baz',
                    ],
                ],
            ],
        ];

        $this->assertEquals([
            0 => [
                'tags' => [
                    '#foo',
                    '#bar',
                ],
            ],
            1 => [
                'tags' => [
                    '#baz',
                ],
            ],
        ], Arr::pluck($data, 'comments'));

        $this->assertEquals([['#foo', '#bar'], ['#baz']], Arr::pluck($data, 'comments.tags'));
        $this->assertEquals([null, null], Arr::pluck($data, 'foo'));
        $this->assertEquals([null, null], Arr::pluck($data, 'foo.bar'));

        $array = [
            ['developer' => ['name' => 'Taylor']],
            ['developer' => ['name' => 'Abigail']],
        ];

        $array = Arr::pluck($array, 'developer.name');

        $this->assertEquals(['Taylor', 'Abigail'], $array);
    }

    public function testPluckWithArrayValue()
    {
        $array = [
            ['developer' => ['name' => 'Taylor']],
            ['developer' => ['name' => 'Abigail']],
        ];
        $array = Arr::pluck($array, ['developer', 'name']);
        $this->assertEquals(['Taylor', 'Abigail'], $array);
    }

    public function testPluckWithKeys()
    {
        $array = [
            ['name' => 'Taylor', 'role' => 'developer'],
            ['name' => 'Abigail', 'role' => 'developer'],
        ];

        $test1 = Arr::pluck($array, 'role', 'name');
        $test2 = Arr::pluck($array, null, 'name');

        $this->assertEquals([
            'Taylor' => 'developer',
            'Abigail' => 'developer',
        ], $test1);

        $this->assertEquals([
            'Taylor' => ['name' => 'Taylor', 'role' => 'developer'],
            'Abigail' => ['name' => 'Abigail', 'role' => 'developer'],
        ], $test2);
    }

    public function testPluckWithCarbonKeys()
    {
        $array = [
            ['start' => new Carbon('2017-07-25 00:00:00'), 'end' => new Carbon('2017-07-30 00:00:00')],
        ];
        $array = Arr::pluck($array, 'end', 'start');
        $this->assertEquals(['2017-07-25 00:00:00' => '2017-07-30 00:00:00'], $array);
    }

    public function testArrayPluckWithArrayAndObjectValues()
    {
        $array = [(object) ['name' => 'taylor', 'email' => 'foo'], ['name' => 'dayle', 'email' => 'bar']];
        $this->assertEquals(['taylor', 'dayle'], Arr::pluck($array, 'name'));
        $this->assertEquals(['taylor' => 'foo', 'dayle' => 'bar'], Arr::pluck($array, 'email', 'name'));
    }

    public function testArrayPluckWithNestedKeys()
    {
        $array = [['user' => ['taylor', 'otwell']], ['user' => ['dayle', 'rees']]];
        $this->assertEquals(['taylor', 'dayle'], Arr::pluck($array, 'user.0'));
        $this->assertEquals(['taylor', 'dayle'], Arr::pluck($array, ['user', 0]));
        $this->assertEquals(['taylor' => 'otwell', 'dayle' => 'rees'], Arr::pluck($array, 'user.1', 'user.0'));
        $this->assertEquals(['taylor' => 'otwell', 'dayle' => 'rees'], Arr::pluck($array, ['user', 1], ['user', 0]));
    }

    public function testArrayPluckWithNestedArrays()
    {
        $array = [
            [
                'account' => 'a',
                'users' => [
                    ['first' => 'taylor', 'last' => 'otwell', 'email' => 'taylorotwell@gmail.com'],
                ],
            ],
            [
                'account' => 'b',
                'users' => [
                    ['first' => 'abigail', 'last' => 'otwell'],
                    ['first' => 'dayle', 'last' => 'rees'],
                ],
            ],
        ];

        $this->assertEquals([['taylor'], ['abigail', 'dayle']], Arr::pluck($array, 'users.*.first'));
        $this->assertEquals(['a' => ['taylor'], 'b' => ['abigail', 'dayle']], Arr::pluck($array, 'users.*.first', 'account'));
        $this->assertEquals([['taylorotwell@gmail.com'], [null, null]], Arr::pluck($array, 'users.*.email'));
    }



    public function testMapWithKeys()
    {
        $data = [
            ['name' => 'Blastoise', 'type' => 'Water', 'idx' => 9],
            ['name' => 'Charmander', 'type' => 'Fire', 'idx' => 4],
            ['name' => 'Dragonair', 'type' => 'Dragon', 'idx' => 148],
        ];

        $data = Arr::mapWithKeys($data, function ($pokemon) {
            return [$pokemon['name'] => $pokemon['type']];
        });

        $this->assertEquals(
            ['Blastoise' => 'Water', 'Charmander' => 'Fire', 'Dragonair' => 'Dragon'],
            $data
        );
    }



    public function testMapSpread()
    {
        $c = [[1, 'a'], [2, 'b']];

        $result = Arr::mapSpread($c, function ($number, $character) {
            return "{$number}-{$character}";
        });
        $this->assertEquals(['1-a', '2-b'], $result);

        $result = Arr::mapSpread($c, function ($number, $character, $key) {
            return "{$number}-{$character}-{$key}";
        });
        $this->assertEquals(['1-a-0', '2-b-1'], $result);
    }

    public function testPrepend()
    {
        $array = Arr::prepend(['one', 'two', 'three', 'four'], 'zero');
        $this->assertEquals(['zero', 'one', 'two', 'three', 'four'], $array);

        $array = Arr::prepend(['one' => 1, 'two' => 2], 0, 'zero');
        $this->assertEquals(['zero' => 0, 'one' => 1, 'two' => 2], $array);

        $array = Arr::prepend(['one' => 1, 'two' => 2], 0, null);
        $this->assertEquals([null => 0, 'one' => 1, 'two' => 2], $array);

        $array = Arr::prepend(['one', 'two'], null, '');
        $this->assertEquals(['' => null, 'one', 'two'], $array);

        $array = Arr::prepend([], 'zero');
        $this->assertEquals(['zero'], $array);

        $array = Arr::prepend([''], 'zero');
        $this->assertEquals(['zero', ''], $array);

        $array = Arr::prepend(['one', 'two'], ['zero']);
        $this->assertEquals([['zero'], 'one', 'two'], $array);

        $array = Arr::prepend(['one', 'two'], ['zero'], 'key');
        $this->assertEquals(['key' => ['zero'], 'one', 'two'], $array);
    }

    public function testPull()
    {
        $array = ['name' => 'Desk', 'price' => 100];
        $name = Arr::pull($array, 'name');
        $this->assertSame('Desk', $name);
        $this->assertSame(['price' => 100], $array);

        // Only works on first level keys
        $array = ['joe@example.com' => 'Joe', 'jane@localhost' => 'Jane'];
        $name = Arr::pull($array, 'joe@example.com');
        $this->assertSame('Joe', $name);
        $this->assertSame(['jane@localhost' => 'Jane'], $array);

        // Does not work for nested keys
        $array = ['emails' => ['joe@example.com' => 'Joe', 'jane@localhost' => 'Jane']];
        $name = Arr::pull($array, 'emails.joe@example.com');
        $this->assertNull($name);
        $this->assertSame(['emails' => ['joe@example.com' => 'Joe', 'jane@localhost' => 'Jane']], $array);

        // Works with int keys
        $array = ['First', 'Second'];
        $first = Arr::pull($array, 0);
        $this->assertSame('First', $first);
        $this->assertSame([1 => 'Second'], $array);
    }

    public function testQuery()
    {
        $this->assertSame('', Arr::query([]));
        $this->assertSame('foo=bar', Arr::query(['foo' => 'bar']));
        $this->assertSame('foo=bar&bar=baz', Arr::query(['foo' => 'bar', 'bar' => 'baz']));
        $this->assertSame('foo=bar&bar=1', Arr::query(['foo' => 'bar', 'bar' => true]));
        $this->assertSame('foo=bar', Arr::query(['foo' => 'bar', 'bar' => null]));
        $this->assertSame('foo=bar&bar=', Arr::query(['foo' => 'bar', 'bar' => '']));
    }

    public function testSoleReturnsFirstItemInCollectionIfOnlyOneExists()
    {
        $this->assertSame('foo', Arr::sole(['foo']));

        $array = [
            ['name' => 'foo'],
            ['name' => 'bar'],
        ];

        $this->assertSame(
            ['name' => 'foo'],
            Arr::sole($array, fn(array $value) => $value['name'] === 'foo')
        );
    }

    public function testSoleThrowsExceptionIfNoItemsExist()
    {
        $this->expectException(ItemNotFoundException::class);

        Arr::sole(['foo'], fn(string $value) => $value === 'baz');
    }

    public function testSoleThrowsExceptionIfMoreThanOneItemExists()
    {
        $this->expectExceptionObject(new MultipleItemsFoundException(2));

        Arr::sole(['baz', 'foo', 'baz'], fn(string $value) => $value === 'baz');
    }

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

    public function testToCssClasses()
    {
        $classes = Arr::toCssClasses([
            'font-bold',
            'mt-4',
        ]);

        $this->assertSame('font-bold mt-4', $classes);

        $classes = Arr::toCssClasses([
            'font-bold',
            'mt-4',
            'ml-2' => true,
            'mr-2' => false,
        ]);

        $this->assertSame('font-bold mt-4 ml-2', $classes);
    }

    public function testToCssStyles()
    {
        $styles = Arr::toCssStyles([
            'font-weight: bold',
            'margin-top: 4px;',
        ]);

        $this->assertSame('font-weight: bold; margin-top: 4px;', $styles);

        $styles = Arr::toCssStyles([
            'font-weight: bold;',
            'margin-top: 4px',
            'margin-left: 2px;' => true,
            'margin-right: 2px' => false,
        ]);

        $this->assertSame('font-weight: bold; margin-top: 4px; margin-left: 2px;', $styles);
    }

    public function testWhere()
    {
        $array = [100, '200', 300, '400', 500];

        $array = Arr::where($array, function ($value, $key) {
            return is_string($value);
        });

        $this->assertEquals([1 => '200', 3 => '400'], $array);
    }

    public function testWhereKey()
    {
        $array = ['10' => 1, 'foo' => 3, 20 => 2];

        $array = Arr::where($array, function ($value, $key) {
            return is_numeric($key);
        });

        $this->assertEquals(['10' => 1, 20 => 2], $array);
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

    public function testPrependKeysWith()
    {
        $array = [
            'id' => '123',
            'data' => '456',
            'list' => [1, 2, 3],
            'meta' => [
                'key' => 1,
            ],
        ];

        $this->assertEquals([
            'test.id' => '123',
            'test.data' => '456',
            'test.list' => [1, 2, 3],
            'test.meta' => [
                'key' => 1,
            ],
        ], Arr::prependKeysWith($array, 'test.'));
    }

    public function testTake(): void
    {
        $array = [1, 2, 3, 4, 5, 6];

        // Test with a positive limit, should return the first 'limit' elements.
        $this->assertEquals([1, 2, 3], Arr::take($array, 3));

        // Test with a negative limit, should return the last 'abs(limit)' elements.
        $this->assertEquals([4, 5, 6], Arr::take($array, -3));

        // Test with zero limit, should return an empty array.
        $this->assertEquals([], Arr::take($array, 0));

        // Test with a limit greater than the array size, should return the entire array.
        $this->assertEquals([1, 2, 3, 4, 5, 6], Arr::take($array, 10));

        // Test with a negative limit greater than the array size, should return the entire array.
        $this->assertEquals([1, 2, 3, 4, 5, 6], Arr::take($array, -10));
    }

    public function testSelect()
    {
        $array = [
            [
                'name' => 'Taylor',
                'role' => 'Developer',
                'age' => 1,
            ],
            [
                'name' => 'Abigail',
                'role' => 'Infrastructure',
                'age' => 2,
            ],
        ];

        $this->assertEquals([
            [
                'name' => 'Taylor',
                'age' => 1,
            ],
            [
                'name' => 'Abigail',
                'age' => 2,
            ],
        ], Arr::select($array, ['name', 'age']));

        $this->assertEquals([
            [
                'name' => 'Taylor',
            ],
            [
                'name' => 'Abigail',
            ],
        ], Arr::select($array, 'name'));

        $this->assertEquals([
            [],
            [],
        ], Arr::select($array, 'nonExistingKey'));

        $this->assertEquals([
            [],
            [],
        ], Arr::select($array, null));
    }

    public function testReject()
    {
        $array = [1, 2, 3, 4, 5, 6];

        // Test rejection behavior (removing even numbers)
        $result = Arr::reject($array, function ($value) {
            return $value % 2 === 0;
        });

        $this->assertEquals([
            0 => 1,
            2 => 3,
            4 => 5,
        ], $result);

        // Test key preservation with associative array
        $assocArray = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];

        $result = Arr::reject($assocArray, function ($value) {
            return $value > 2;
        });

        $this->assertEquals([
            'a' => 1,
            'b' => 2,
        ], $result);
    }

    public function testPartition()
    {
        $array = ['John', 'Jane', 'Greg'];

        $result = Arr::partition($array, fn(string $value) => str_contains($value, 'J'));

        $this->assertEquals([[0 => 'John', 1 => 'Jane'], [2 => 'Greg']], $result);
    }
}
