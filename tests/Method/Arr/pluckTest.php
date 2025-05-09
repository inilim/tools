<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;
use Inilim\Tool\Test\ForTest\ClassStringable;

class pluckTest extends TestCase
{
    function test()
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

    function testPluckWithArrayValue()
    {
        $array = [
            ['developer' => ['name' => 'Taylor']],
            ['developer' => ['name' => 'Abigail']],
        ];
        $array = Arr::pluck($array, ['developer', 'name']);
        $this->assertEquals(['Taylor', 'Abigail'], $array);
    }

    function testPluckWithKeys()
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

    function testPluckWithCarbonKeys()
    {
        $array = [
            ['start' => new ClassStringable('2017-07-25 00:00:00'), 'end' => new ClassStringable('2017-07-30 00:00:00')],
        ];
        $array = Arr::pluck($array, 'end', 'start');
        $this->assertEquals(['2017-07-25 00:00:00' => '2017-07-30 00:00:00'], $array);
    }

    function testArrayPluckWithArrayAndObjectValues()
    {
        $array = [(object) ['name' => 'taylor', 'email' => 'foo'], ['name' => 'dayle', 'email' => 'bar']];
        $this->assertEquals(['taylor', 'dayle'], Arr::pluck($array, 'name'));
        $this->assertEquals(['taylor' => 'foo', 'dayle' => 'bar'], Arr::pluck($array, 'email', 'name'));
    }

    function testArrayPluckWithNestedKeys()
    {
        $array = [['user' => ['taylor', 'otwell']], ['user' => ['dayle', 'rees']]];

        $this->assertEquals(['taylor', 'dayle'], Arr::pluck($array, 'user.0'));
        $this->assertEquals(['taylor', 'dayle'], Arr::pluck($array, ['user', 0]));
        $this->assertEquals(['taylor' => 'otwell', 'dayle' => 'rees'], Arr::pluck($array, 'user.1', 'user.0'));
        $this->assertEquals(['taylor' => 'otwell', 'dayle' => 'rees'], Arr::pluck($array, ['user', 1], ['user', 0]));
    }

    function testArrayPluckWithNestedArrays()
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
}
