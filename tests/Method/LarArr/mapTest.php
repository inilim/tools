<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\TestCase;

class mapTest extends TestCase
{
    public function testMap()
    {
        $data = ['first' => 'taylor', 'last' => 'otwell'];
        $mapped = LarArr::map($data, function ($value, $key) {
            return $key . '-' . strrev($value);
        });
        $this->assertEquals(['first' => 'first-rolyat', 'last' => 'last-llewto'], $mapped);
        $this->assertEquals(['first' => 'taylor', 'last' => 'otwell'], $data);
    }

    public function testMapWithEmptyArray()
    {
        $mapped = LarArr::map([], static function ($value, $key) {
            return $key . '-' . $value;
        });
        $this->assertEquals([], $mapped);
    }

    public function testMapNullValues()
    {
        $data = ['first' => 'taylor', 'last' => null];
        $mapped = LarArr::map($data, static function ($value, $key) {
            return $key . '-' . $value;
        });
        $this->assertEquals(['first' => 'first-taylor', 'last' => 'last-'], $mapped);
    }

    // public function testMapByReference()
    // {
    //     $data = ['first' => 'taylor', 'last' => 'otwell'];
    //     // TODO strrev() expects exactly 1 parameter, 2 given
    //     $mapped = LarArr::map($data, 'strrev');

    //     $this->assertEquals(['first' => 'rolyat', 'last' => 'llewto'], $mapped);
    //     $this->assertEquals(['first' => 'taylor', 'last' => 'otwell'], $data);
    // }
}

