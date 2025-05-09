<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class selectTest extends TestCase
{
    function test()
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
}
