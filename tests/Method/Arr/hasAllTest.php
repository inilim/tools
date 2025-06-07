<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class hasAllTest extends TestCase
{
    function test()
    {
        $array = ['name' => 'Taylor', 'age' => '', 'city' => null];
        $this->assertTrue(Arr::hasAll($array, 'name'));
        $this->assertTrue(Arr::hasAll($array, 'age'));
        $this->assertFalse(Arr::hasAll($array, ['age', 'car']));
        $this->assertTrue(Arr::hasAll($array, 'city'));
        $this->assertFalse(Arr::hasAll($array, ['city', 'some']));
        $this->assertTrue(Arr::hasAll($array, ['name', 'age', 'city']));
        $this->assertFalse(Arr::hasAll($array, ['name', 'age', 'city', 'country']));

        $array = ['user' => ['name' => 'Taylor']];
        $this->assertTrue(Arr::hasAll($array, 'user.name'));
        $this->assertFalse(Arr::hasAll($array, 'user.age'));

        $array = ['name' => 'Taylor', 'age' => '', 'city' => null];
        $this->assertFalse(Arr::hasAll($array, 'foo'));
        $this->assertFalse(Arr::hasAll($array, 'bar'));
        $this->assertFalse(Arr::hasAll($array, 'baz'));
        $this->assertFalse(Arr::hasAll($array, 'bah'));
        $this->assertFalse(Arr::hasAll($array, ['foo', 'bar', 'baz', 'bar']));
    }
}
