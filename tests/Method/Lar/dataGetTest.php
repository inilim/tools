<?php

namespace Inilim\Tool\Test\Method\Lar;

use Inilim\Tool\Lar;
use Inilim\Tool\Test\TestCase;

class dataGetTest extends TestCase
{
    function test()
    {
        $object = (object) ['users' => ['name' => ['Taylor', 'Otwell']]];
        $array = [(object) ['users' => [(object) ['name' => 'Taylor']]]];
        $dottedArray = ['users' => ['first.name' => 'Taylor', 'middle.name' => null]];
        $arrayAccess = new SupportTestArrayAccess(['price' => 56, 'user' => new SupportTestArrayAccess(['name' => 'John']), 'email' => null]);

        $this->assertSame('Taylor', Lar::dataGet($object, 'users.name.0'));
        $this->assertSame('Taylor', Lar::dataGet($array, '0.users.0.name'));
        $this->assertNull(Lar::dataGet($array, '0.users.3'));
        $this->assertSame('Not found', Lar::dataGet($array, '0.users.3', 'Not found'));
        $this->assertSame('Not found', Lar::dataGet($array, '0.users.3', static function () {
            return 'Not found';
        }));
        $this->assertSame('Taylor', Lar::dataGet($dottedArray, ['users', 'first.name']));
        $this->assertNull(Lar::dataGet($dottedArray, ['users', 'middle.name']));
        $this->assertSame('Not found', Lar::dataGet($dottedArray, ['users', 'last.name'], 'Not found'));
        $this->assertEquals(56, Lar::dataGet($arrayAccess, 'price'));
        $this->assertSame('John', Lar::dataGet($arrayAccess, 'user.name'));
        $this->assertSame('void', Lar::dataGet($arrayAccess, 'foo', 'void'));
        $this->assertSame('void', Lar::dataGet($arrayAccess, 'user.foo', 'void'));
        $this->assertNull(Lar::dataGet($arrayAccess, 'foo'));
        $this->assertNull(Lar::dataGet($arrayAccess, 'user.foo'));
        $this->assertNull(Lar::dataGet($arrayAccess, 'email', 'Not found'));
        $this->assertEquals('taylor', Lar::dataGet(['user' => ['taylor', 'otwell']], ['user', 0]));
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

        $this->assertEquals(['taylor', 'abigail', 'dayle'], Lar::dataGet($array, '*.name'));
        $this->assertEquals(['taylorotwell@gmail.com', null, null], Lar::dataGet($array, '*.email', 'irrelevant'));

        $this->assertEquals(['taylor', 'abigail', 'dayle'], Lar::dataGet($arrayIterable, '*.name'));
        $this->assertEquals(['taylorotwell@gmail.com', null, null], Lar::dataGet($arrayIterable, '*.email', 'irrelevant'));

        $array = [
            'users' => [
                ['first' => 'taylor', 'last' => 'otwell', 'email' => 'taylorotwell@gmail.com'],
                ['first' => 'abigail', 'last' => 'otwell'],
                ['first' => 'dayle', 'last' => 'rees'],
            ],
            'posts' => null,
        ];

        $this->assertEquals(['taylor', 'abigail', 'dayle'], Lar::dataGet($array, 'users.*.first'));
        $this->assertEquals(['taylorotwell@gmail.com', null, null], Lar::dataGet($array, 'users.*.email', 'irrelevant'));
        $this->assertSame('not found', Lar::dataGet($array, 'posts.*.date', 'not found'));
        $this->assertNull(Lar::dataGet($array, 'posts.*.date'));
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

        $this->assertEquals(['taylor', 'abigail', 'abigail', 'dayle', 'dayle', 'taylor'], Lar::dataGet($array, 'posts.*.comments.*.author'));
        $this->assertEquals([4, 3, 2, null, null, 1], Lar::dataGet($array, 'posts.*.comments.*.likes'));
        $this->assertEquals([], Lar::dataGet($array, 'posts.*.users.*.name', 'irrelevant'));
        $this->assertEquals([], Lar::dataGet($array, 'posts.*.users.*.name'));
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

        $this->assertEquals('LHR', Lar::dataGet($array, 'flights.0.segments.{first}.from'));
        $this->assertEquals('PKX', Lar::dataGet($array, 'flights.0.segments.{last}.to'));

        $this->assertEquals('LHR', Lar::dataGet($array, 'flights.{first}.segments.{first}.from'));
        $this->assertEquals('PEK', Lar::dataGet($array, 'flights.{last}.segments.{last}.to'));
        $this->assertEquals('PKX', Lar::dataGet($array, 'flights.{first}.segments.{last}.to'));
        $this->assertEquals('LGW', Lar::dataGet($array, 'flights.{last}.segments.{first}.from'));

        $this->assertEquals(['LHR', 'IST'], Lar::dataGet($array, 'flights.{first}.segments.*.from'));
        $this->assertEquals(['SAW', 'PEK'], Lar::dataGet($array, 'flights.{last}.segments.*.to'));

        $this->assertEquals(['LHR', 'LGW'], Lar::dataGet($array, 'flights.*.segments.{first}.from'));
        $this->assertEquals(['PKX', 'PEK'], Lar::dataGet($array, 'flights.*.segments.{last}.to'));

        $this->assertEquals('Not found', Lar::dataGet($array, 'empty.{first}', 'Not found'));
        $this->assertEquals('Not found', Lar::dataGet($array, 'empty.{last}', 'Not found'));
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

        $this->assertEquals('LHR', Lar::dataGet($arrayAccessIterable, 'flights.0.segments.{first}.from'));
        $this->assertEquals('PKX', Lar::dataGet($arrayAccessIterable, 'flights.0.segments.{last}.to'));

        $this->assertEquals('LHR', Lar::dataGet($arrayAccessIterable, 'flights.{first}.segments.{first}.from'));
        $this->assertEquals('PEK', Lar::dataGet($arrayAccessIterable, 'flights.{last}.segments.{last}.to'));
        $this->assertEquals('PKX', Lar::dataGet($arrayAccessIterable, 'flights.{first}.segments.{last}.to'));
        $this->assertEquals('LGW', Lar::dataGet($arrayAccessIterable, 'flights.{last}.segments.{first}.from'));

        $this->assertEquals(['LHR', 'IST'], Lar::dataGet($arrayAccessIterable, 'flights.{first}.segments.*.from'));
        $this->assertEquals(['SAW', 'PEK'], Lar::dataGet($arrayAccessIterable, 'flights.{last}.segments.*.to'));

        $this->assertEquals(['LHR', 'LGW'], Lar::dataGet($arrayAccessIterable, 'flights.*.segments.{first}.from'));
        $this->assertEquals(['PKX', 'PEK'], Lar::dataGet($arrayAccessIterable, 'flights.*.segments.{last}.to'));

        $this->assertEquals('Not found', Lar::dataGet($arrayAccessIterable, 'empty.{first}', 'Not found'));
        $this->assertEquals('Not found', Lar::dataGet($arrayAccessIterable, 'empty.{last}', 'Not found'));
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

        $this->assertEquals('second', Lar::dataGet($array, 'numericKeys.0'));
        $this->assertEquals('first', Lar::dataGet($array, 'numericKeys.{first}'));
        $this->assertEquals('last', Lar::dataGet($array, 'numericKeys.{last}'));
        $this->assertEquals('first', Lar::dataGet($array, 'stringKeys.{first}'));
        $this->assertEquals('last', Lar::dataGet($array, 'stringKeys.{last}'));
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

        $this->assertEquals('caret', Lar::dataGet($array, 'symbols.\{first}.description'));
        $this->assertEquals('dollar', Lar::dataGet($array, 'symbols.{first}.description'));
        $this->assertEquals('asterisk', Lar::dataGet($array, 'symbols.\*.description'));
        $this->assertEquals(['dollar', 'asterisk', 'caret'], Lar::dataGet($array, 'symbols.*.description'));
        $this->assertEquals('dollar', Lar::dataGet($array, 'symbols.\{last}.description'));
        $this->assertEquals('caret', Lar::dataGet($array, 'symbols.{last}.description'));
    }

    function testStar()
    {
        $data = ['foo' => 'bar'];
        $this->assertEquals(['bar'], Lar::dataGet($data, '*'));

        // $data = collect(['foo' => 'bar']);
        $data = new \stdClass;
        $data->foo = 'bar';
        $this->assertEquals(['bar'], Lar::dataGet($data, '*'));
    }

    function testNullKey()
    {
        $data = ['foo' => 'bar'];

        $this->assertEquals(['foo' => 'bar'], Lar::dataGet($data, null));
        $this->assertEquals(['foo' => 'bar'], Lar::dataGet($data, null, '42'));
        $this->assertEquals(['foo' => 'bar'], Lar::dataGet($data, [null]));

        $data = ['foo' => 'bar', 'baz' => 42];
        $this->assertEquals(['foo' => 'bar', 'baz' => 42], Lar::dataGet($data, [null, 'foo']));
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
