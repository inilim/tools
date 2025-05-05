<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class setTest extends TestCase
{
    function test()
    {
        $array = ['products' => ['desk' => ['price' => 100]]];
        Arr::set()($array, 'products.desk.price', 200);
        $this->assertEquals(['products' => ['desk' => ['price' => 200]]], $array);

        // No key is given
        $array = ['products' => ['desk' => ['price' => 100]]];
        Arr::set()($array, null, ['price' => 300]);
        $this->assertSame(['price' => 300], $array);

        // The key doesn't exist at the depth
        $array = ['products' => 'desk'];
        Arr::set()($array, 'products.desk.price', 200);
        $this->assertSame(['products' => ['desk' => ['price' => 200]]], $array);

        // No corresponding key exists
        $array = ['products'];
        Arr::set()($array, 'products.desk.price', 200);
        $this->assertSame(['products', 'products' => ['desk' => ['price' => 200]]], $array);

        $array = ['products' => ['desk' => ['price' => 100]]];
        Arr::set()($array, 'table', 500);
        $this->assertSame(['products' => ['desk' => ['price' => 100]], 'table' => 500], $array);

        $array = ['products' => ['desk' => ['price' => 100]]];
        Arr::set()($array, 'table.price', 350);
        $this->assertSame(['products' => ['desk' => ['price' => 100]], 'table' => ['price' => 350]], $array);

        $array = [];
        Arr::set()($array, 'products.desk.price', 200);
        $this->assertSame(['products' => ['desk' => ['price' => 200]]], $array);

        // Override
        $array = ['products' => 'table'];
        Arr::set()($array, 'products.desk.price', 300);
        $this->assertSame(['products' => ['desk' => ['price' => 300]]], $array);

        $array = [1 => 'test'];
        $this->assertEquals([1 => 'hAz'], Arr::set()($array, 1, 'hAz'));
    }
}
