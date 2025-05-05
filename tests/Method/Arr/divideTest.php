<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class divideTest extends TestCase
{
    function test()
    {
        // Test dividing an empty array
        [$keys, $values] = Arr::divide([]);
        $this->assertEquals([], $keys);
        $this->assertEquals([], $values);

        // Test dividing an array with a single key-value pair
        [$keys, $values] = Arr::divide(['name' => 'Desk']);
        $this->assertEquals(['name'], $keys);
        $this->assertEquals(['Desk'], $values);

        // Test dividing an array with multiple key-value pairs
        [$keys, $values] = Arr::divide(['name' => 'Desk', 'price' => 100, 'available' => true]);
        $this->assertEquals(['name', 'price', 'available'], $keys);
        $this->assertEquals(['Desk', 100, true], $values);

        // Test dividing an array with numeric keys
        [$keys, $values] = Arr::divide([0 => 'first', 1 => 'second']);
        $this->assertEquals([0, 1], $keys);
        $this->assertEquals(['first', 'second'], $values);

        // Test dividing an array with null key
        [$keys, $values] = Arr::divide([null => 'Null', 1 => 'one']);
        $this->assertEquals([null, 1], $keys);
        $this->assertEquals(['Null', 'one'], $values);

        // Test dividing an array where the keys are arrays
        [$keys, $values] = Arr::divide([['one' => 1, 2 => 'second'], 1 => 'one']);
        $this->assertEquals([0, 1], $keys);
        $this->assertEquals([['one' => 1, 2 => 'second'], 'one'], $values);

        // Test dividing an array where the values are arrays
        [$keys, $values] = Arr::divide([null => ['one' => 1, 2 => 'second'], 1 => 'one']);
        $this->assertEquals([null, 1], $keys);
        $this->assertEquals([['one' => 1, 2 => 'second'], 'one'], $values);
    }
}
