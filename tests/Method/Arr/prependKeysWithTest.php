<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class prependKeysWithTest extends TestCase
{
    function test()
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
}
