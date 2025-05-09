<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;
use Inilim\Tool\Test\ForTest\ClassStringable;

class pullTest extends TestCase
{
    function test()
    {
        $array = ['name' => 'Desk', 'price' => 100];
        $name = Arr::pull()($array, 'name');
        $this->assertSame('Desk', $name);
        $this->assertSame(['price' => 100], $array);

        // Only works on first level keys
        $array = ['joe@example.com' => 'Joe', 'jane@localhost' => 'Jane'];
        $name = Arr::pull()($array, 'joe@example.com');
        $this->assertSame('Joe', $name);
        $this->assertSame(['jane@localhost' => 'Jane'], $array);

        // Does not work for nested keys
        $array = ['emails' => ['joe@example.com' => 'Joe', 'jane@localhost' => 'Jane']];
        $name = Arr::pull()($array, 'emails.joe@example.com');
        $this->assertNull($name);
        $this->assertSame(['emails' => ['joe@example.com' => 'Joe', 'jane@localhost' => 'Jane']], $array);

        // Works with int keys
        $array = ['First', 'Second'];
        $first = Arr::pull()($array, 0);
        $this->assertSame('First', $first);
        $this->assertSame([1 => 'Second'], $array);
    }
}
