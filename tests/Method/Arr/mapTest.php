<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class mapTest extends TestCase
{
    function test()
    {
        $data = ['first' => 'taylor', 'last' => 'otwell'];
        $mapped = Arr::map($data, function ($value, $key) {
            return $key . '-' . strrev($value);
        });
        $this->assertEquals(['first' => 'first-rolyat', 'last' => 'last-llewto'], $mapped);
        $this->assertEquals(['first' => 'taylor', 'last' => 'otwell'], $data);
    }

    function testMapByReference()
    {
        // php7.4 ругается на то что в функцию входят лишние аргументы
        function strrev2($value, $key)
        {
            return \strrev($value);
        }

        $data = ['first' => 'taylor', 'last' => 'otwell'];
        $mapped = Arr::map($data, 'Inilim\Tool\Test\Method\Arr\strrev2');

        $this->assertEquals(['first' => 'rolyat', 'last' => 'llewto'], $mapped);
        $this->assertEquals(['first' => 'taylor', 'last' => 'otwell'], $data);
    }

    function testMapWithEmptyArray()
    {
        $mapped = Arr::map([], static function ($value, $key) {
            return $key . '-' . $value;
        });
        $this->assertEquals([], $mapped);
    }

    function testMapNullValues()
    {
        $data = ['first' => 'taylor', 'last' => null];
        $mapped = Arr::map($data, static function ($value, $key) {
            return $key . '-' . $value;
        });
        $this->assertEquals(['first' => 'first-taylor', 'last' => 'last-'], $mapped);
    }
}
