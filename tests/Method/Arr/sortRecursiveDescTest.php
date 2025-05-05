<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class sortRecursiveDescTest extends TestCase
{
    function test()
    {
        $array = [
            'empty' => [],
            'nested' => [
                'level1' => [
                    'level2' => [
                        'level3' => [2, 3, 1],
                    ],
                    'values' => [4, 5, 6],
                ],
            ],
            'mixed' => [
                'a' => 1,
                2 => 'b',
                'c' => 3,
                1 => 'd',
            ],
            'numbered_index' => [
                1 => 'e',
                3 => 'c',
                4 => 'b',
                5 => 'a',
                2 => 'd',
            ],
        ];

        $expect = [
            'empty' => [],
            'mixed' => [
                'c' => 3,
                'a' => 1,
                2 => 'b',
                1 => 'd',
            ],
            'nested' => [
                'level1' => [
                    'values' => [6, 5, 4],
                    'level2' => [
                        'level3' => [3, 2, 1],
                    ],
                ],
            ],
            'numbered_index' => [
                5 => 'a',
                4 => 'b',
                3 => 'c',
                2 => 'd',
                1 => 'e',
            ],
        ];

        $this->assertEquals($expect, Arr::sortRecursiveDesc($array));
    }
}
