<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class dataGetTest extends TestCase
{
    function test()
    {
        $object = (object) ['users' => ['name' => ['Taylor', 'Otwell']]];
        $array = [(object) ['users' => [(object) ['name' => 'Taylor']]]];
        $dottedArray = ['users' => ['first.name' => 'Taylor', 'middle.name' => null]];
        $arrayAccess = new SupportTestArrayAccess(['price' => 56, 'user' => new SupportTestArrayAccess(['name' => 'John']), 'email' => null]);

        $this->assertSame('Taylor', Arr::dataGet($object, 'users.name.0'));
        $this->assertSame('Taylor', Arr::dataGet($array, '0.users.0.name'));
        $this->assertNull(Arr::dataGet($array, '0.users.3'));
        $this->assertSame('Not found', Arr::dataGet($array, '0.users.3', 'Not found'));
        $this->assertSame('Not found', Arr::dataGet($array, '0.users.3', static function () {
            return 'Not found';
        }));
        $this->assertSame('Taylor', Arr::dataGet($dottedArray, ['users', 'first.name']));
        $this->assertNull(Arr::dataGet($dottedArray, ['users', 'middle.name']));
        $this->assertSame('Not found', Arr::dataGet($dottedArray, ['users', 'last.name'], 'Not found'));
        $this->assertEquals(56, Arr::dataGet($arrayAccess, 'price'));
        $this->assertSame('John', Arr::dataGet($arrayAccess, 'user.name'));
        $this->assertSame('void', Arr::dataGet($arrayAccess, 'foo', 'void'));
        $this->assertSame('void', Arr::dataGet($arrayAccess, 'user.foo', 'void'));
        $this->assertNull(Arr::dataGet($arrayAccess, 'foo'));
        $this->assertNull(Arr::dataGet($arrayAccess, 'user.foo'));
        $this->assertNull(Arr::dataGet($arrayAccess, 'email', 'Not found'));
    }

    function testWithNestedArrays()
    {
        $array = [
            ['name' => 'taylor', 'email' => 'taylorotwell@gmail.com'],
            ['name' => 'abigail'],
            ['name' => 'dayle'],
        ];
        $arrayIterable = new SupportTestArrayIterable([
            ['name' => 'taylor', 'email' => 'taylorotwell@gmail.com'],
            ['name' => 'abigail'],
            ['name' => 'dayle'],
        ]);

        $this->assertEquals(['taylor', 'abigail', 'dayle'], Arr::dataGet($array, '*.name'));
        $this->assertEquals(['taylorotwell@gmail.com', null, null], Arr::dataGet($array, '*.email', 'irrelevant'));

        $this->assertEquals(['taylor', 'abigail', 'dayle'], Arr::dataGet($arrayIterable, '*.name'));
        $this->assertEquals(['taylorotwell@gmail.com', null, null], Arr::dataGet($arrayIterable, '*.email', 'irrelevant'));

        $array = [
            'users' => [
                ['first' => 'taylor', 'last' => 'otwell', 'email' => 'taylorotwell@gmail.com'],
                ['first' => 'abigail', 'last' => 'otwell'],
                ['first' => 'dayle', 'last' => 'rees'],
            ],
            'posts' => null,
        ];

        $this->assertEquals(['taylor', 'abigail', 'dayle'], Arr::dataGet($array, 'users.*.first'));
        $this->assertEquals(['taylorotwell@gmail.com', null, null], Arr::dataGet($array, 'users.*.email', 'irrelevant'));
        $this->assertSame('not found', Arr::dataGet($array, 'posts.*.date', 'not found'));
        $this->assertNull(Arr::dataGet($array, 'posts.*.date'));
    }

    function testWithDoubleNestedArraysCollapsesResult()
    {
        $array = [
            'posts' => [
                [
                    'comments' => [
                        ['author' => 'taylor', 'likes' => 4],
                        ['author' => 'abigail', 'likes' => 3],
                    ],
                ],
                [
                    'comments' => [
                        ['author' => 'abigail', 'likes' => 2],
                        ['author' => 'dayle'],
                    ],
                ],
                [
                    'comments' => [
                        ['author' => 'dayle'],
                        ['author' => 'taylor', 'likes' => 1],
                    ],
                ],
            ],
        ];

        $this->assertEquals(['taylor', 'abigail', 'abigail', 'dayle', 'dayle', 'taylor'], Arr::dataGet($array, 'posts.*.comments.*.author'));
        $this->assertEquals([4, 3, 2, null, null, 1], Arr::dataGet($array, 'posts.*.comments.*.likes'));
        $this->assertEquals([], Arr::dataGet($array, 'posts.*.users.*.name', 'irrelevant'));
        $this->assertEquals([], Arr::dataGet($array, 'posts.*.users.*.name'));
    }

    function testFirstLastDirectives()
    {
        $array = [
            'flights' => [
                [
                    'segments' => [
                        ['from' => 'LHR', 'departure' => '9:00', 'to' => 'IST', 'arrival' => '15:00'],
                        ['from' => 'IST', 'departure' => '16:00', 'to' => 'PKX', 'arrival' => '20:00'],
                    ],
                ],
                [
                    'segments' => [
                        ['from' => 'LGW', 'departure' => '8:00', 'to' => 'SAW', 'arrival' => '14:00'],
                        ['from' => 'SAW', 'departure' => '15:00', 'to' => 'PEK', 'arrival' => '19:00'],
                    ],
                ],
            ],
            'empty' => [],
        ];

        $this->assertEquals('LHR', Arr::dataGet($array, 'flights.0.segments.{first}.from'));
        $this->assertEquals('PKX', Arr::dataGet($array, 'flights.0.segments.{last}.to'));

        $this->assertEquals('LHR', Arr::dataGet($array, 'flights.{first}.segments.{first}.from'));
        $this->assertEquals('PEK', Arr::dataGet($array, 'flights.{last}.segments.{last}.to'));
        $this->assertEquals('PKX', Arr::dataGet($array, 'flights.{first}.segments.{last}.to'));
        $this->assertEquals('LGW', Arr::dataGet($array, 'flights.{last}.segments.{first}.from'));

        $this->assertEquals(['LHR', 'IST'], Arr::dataGet($array, 'flights.{first}.segments.*.from'));
        $this->assertEquals(['SAW', 'PEK'], Arr::dataGet($array, 'flights.{last}.segments.*.to'));

        $this->assertEquals(['LHR', 'LGW'], Arr::dataGet($array, 'flights.*.segments.{first}.from'));
        $this->assertEquals(['PKX', 'PEK'], Arr::dataGet($array, 'flights.*.segments.{last}.to'));

        $this->assertEquals('Not found', Arr::dataGet($array, 'empty.{first}', 'Not found'));
        $this->assertEquals('Not found', Arr::dataGet($array, 'empty.{last}', 'Not found'));
    }

    function testFirstLastDirectivesOnArrayAccessIterable()
    {
        $arrayAccessIterable = [
            'flights' => new SupportTestArrayAccessIterable([
                [
                    'segments' => new SupportTestArrayAccessIterable([
                        ['from' => 'LHR', 'departure' => '9:00', 'to' => 'IST', 'arrival' => '15:00'],
                        ['from' => 'IST', 'departure' => '16:00', 'to' => 'PKX', 'arrival' => '20:00'],
                    ]),
                ],
                [
                    'segments' => new SupportTestArrayAccessIterable([
                        ['from' => 'LGW', 'departure' => '8:00', 'to' => 'SAW', 'arrival' => '14:00'],
                        ['from' => 'SAW', 'departure' => '15:00', 'to' => 'PEK', 'arrival' => '19:00'],
                    ]),
                ],
            ]),
            'empty' => new SupportTestArrayAccessIterable([]),
        ];

        $this->assertEquals('LHR', Arr::dataGet($arrayAccessIterable, 'flights.0.segments.{first}.from'));
        $this->assertEquals('PKX', Arr::dataGet($arrayAccessIterable, 'flights.0.segments.{last}.to'));

        $this->assertEquals('LHR', Arr::dataGet($arrayAccessIterable, 'flights.{first}.segments.{first}.from'));
        $this->assertEquals('PEK', Arr::dataGet($arrayAccessIterable, 'flights.{last}.segments.{last}.to'));
        $this->assertEquals('PKX', Arr::dataGet($arrayAccessIterable, 'flights.{first}.segments.{last}.to'));
        $this->assertEquals('LGW', Arr::dataGet($arrayAccessIterable, 'flights.{last}.segments.{first}.from'));

        $this->assertEquals(['LHR', 'IST'], Arr::dataGet($arrayAccessIterable, 'flights.{first}.segments.*.from'));
        $this->assertEquals(['SAW', 'PEK'], Arr::dataGet($arrayAccessIterable, 'flights.{last}.segments.*.to'));

        $this->assertEquals(['LHR', 'LGW'], Arr::dataGet($arrayAccessIterable, 'flights.*.segments.{first}.from'));
        $this->assertEquals(['PKX', 'PEK'], Arr::dataGet($arrayAccessIterable, 'flights.*.segments.{last}.to'));

        $this->assertEquals('Not found', Arr::dataGet($arrayAccessIterable, 'empty.{first}', 'Not found'));
        $this->assertEquals('Not found', Arr::dataGet($arrayAccessIterable, 'empty.{last}', 'Not found'));
    }

    function testFirstLastDirectivesOnKeyedArrays()
    {
        $array = [
            'numericKeys' => [
                2 => 'first',
                0 => 'second',
                1 => 'last',
            ],
            'stringKeys' => [
                'one' => 'first',
                'two' => 'second',
                'three' => 'last',
            ],
        ];

        $this->assertEquals('second', Arr::dataGet($array, 'numericKeys.0'));
        $this->assertEquals('first', Arr::dataGet($array, 'numericKeys.{first}'));
        $this->assertEquals('last', Arr::dataGet($array, 'numericKeys.{last}'));
        $this->assertEquals('first', Arr::dataGet($array, 'stringKeys.{first}'));
        $this->assertEquals('last', Arr::dataGet($array, 'stringKeys.{last}'));
    }

    function testEscapedSegmentKeys()
    {
        $array = [
            'symbols' => [
                '{last}' => ['description' => 'dollar'],
                '*' => ['description' => 'asterisk'],
                '{first}' => ['description' => 'caret'],
            ],
        ];

        $this->assertEquals('caret', Arr::dataGet($array, 'symbols.\{first}.description'));
        $this->assertEquals('dollar', Arr::dataGet($array, 'symbols.{first}.description'));
        $this->assertEquals('asterisk', Arr::dataGet($array, 'symbols.\*.description'));
        $this->assertEquals(['dollar', 'asterisk', 'caret'], Arr::dataGet($array, 'symbols.*.description'));
        $this->assertEquals('dollar', Arr::dataGet($array, 'symbols.\{last}.description'));
        $this->assertEquals('caret', Arr::dataGet($array, 'symbols.{last}.description'));
    }

    function testStar()
    {
        $data = ['foo' => 'bar'];
        $this->assertEquals(['bar'], Arr::dataGet($data, '*'));

        // $data = collect(['foo' => 'bar']);
        $data = new \stdClass;
        $data->foo = 'bar';
        $this->assertEquals(['bar'], Arr::dataGet($data, '*'));
    }

    function testNullKey()
    {
        $data = ['foo' => 'bar'];

        $this->assertEquals(['foo' => 'bar'], Arr::dataGet($data, null));
        $this->assertEquals(['foo' => 'bar'], Arr::dataGet($data, null, '42'));
        $this->assertEquals(['foo' => 'bar'], Arr::dataGet($data, [null]));

        $data = ['foo' => 'bar', 'baz' => 42];
        $this->assertEquals(['foo' => 'bar', 'baz' => 42], Arr::dataGet($data, [null, 'foo']));
    }
}

// ---------------------------------------------
// 
// ---------------------------------------------

trait SupportTestTraitArrayIterable
{
    protected array $items = [];

    function __construct(array $items = [])
    {
        $this->items = $items;
    }

    function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }
}

trait SupportTestTraitArrayAccess
{
    protected array $items = [];

    function __construct(array $items = [])
    {
        $this->items = $items;
    }

    function offsetExists($offset): bool
    {
        return \array_key_exists($offset, $this->items);
    }

    function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    function offsetSet($offset, $value): void
    {
        $this->items[$offset] = $value;
    }

    function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }
}

class SupportTestArrayAccess implements \ArrayAccess
{
    use SupportTestTraitArrayAccess;
}

class SupportTestArrayIterable implements \IteratorAggregate
{
    use SupportTestTraitArrayIterable;
}

class SupportTestArrayAccessIterable implements \ArrayAccess, \IteratorAggregate
{
    use SupportTestTraitArrayAccess, SupportTestTraitArrayIterable {
        SupportTestTraitArrayAccess::__construct insteadof SupportTestTraitArrayIterable;
    }
}
