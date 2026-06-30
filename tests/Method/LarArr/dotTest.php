<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\TestCase;

class dotTest extends TestCase
{
    function test()
    {
        $array = LarArr::dot(['foo' => ['bar' => 'baz']]);
        $this->assertSame(['foo.bar' => 'baz'], $array);

        $array = LarArr::dot([10 => 100]);
        $this->assertSame([10 => 100], $array);

        $array = LarArr::dot(['foo' => [10 => 100]]);
        $this->assertSame(['foo.10' => 100], $array);

        $array = LarArr::dot([]);
        $this->assertSame([], $array);

        $array = LarArr::dot(['foo' => []]);
        $this->assertSame(['foo' => []], $array);

        $array = LarArr::dot(['foo' => ['bar' => []]]);
        $this->assertSame(['foo.bar' => []], $array);

        $array = LarArr::dot(['name' => 'taylor', 'languages' => ['php' => true]]);
        $this->assertSame(['name' => 'taylor', 'languages.php' => true], $array);

        $array = LarArr::dot(['user' => ['name' => 'Taylor', 'age' => 25, 'languages' => ['PHP', 'C#']]]);
        $this->assertSame([
            'user.name' => 'Taylor',
            'user.age' => 25,
            'user.languages.0' => 'PHP',
            'user.languages.1' => 'C#',
        ], $array);

        $array = LarArr::dot(['foo', 'foo' => ['bar' => 'baz', 'baz' => ['a' => 'b']]]);
        $this->assertSame([
            'foo',
            'foo.bar' => 'baz',
            'foo.baz.a' => 'b',
        ], $array);

        $array = LarArr::dot(['foo' => 'bar', 'empty_array' => [], 'user' => ['name' => 'Taylor'], 'key' => 'value']);
        $this->assertSame([
            'foo' => 'bar',
            'empty_array' => [],
            'user.name' => 'Taylor',
            'key' => 'value',
        ], $array);
    }

    function testDotWithDepth()
    {
        $array = LarArr::dot(['user' => ['name' => 'Taylor', 'address' => ['city' => 'Dallas']]], '', 1);
        $this->assertSame([
            'user.name' => 'Taylor',
            'user.address' => ['city' => 'Dallas'],
        ], $array);

        $array = LarArr::dot(['user' => ['address' => ['city' => ['name' => 'Dallas']]]], '', 2);
        $this->assertSame([
            'user.address.city' => ['name' => 'Dallas'],
        ], $array);

        $array = LarArr::dot(['user' => ['address' => ['city' => ['name' => 'Dallas']]]], '', INF);
        $this->assertSame([
            'user.address.city.name' => 'Dallas',
        ], $array);

        $array = LarArr::dot(['name' => 'taylor', 'languages' => ['php' => true, 'js' => ['react' => true]]], '', 1);
        $this->assertSame([
            'name' => 'taylor',
            'languages.php' => true,
            'languages.js' => ['react' => true],
        ], $array);

        $array = LarArr::dot(['foo' => ['bar' => []]], '', 1);
        $this->assertSame(['foo.bar' => []], $array);

        $array = LarArr::dot(['user' => ['name' => 'Taylor', 'address' => ['city' => 'Dallas']]], '', 0);
        $this->assertSame([
            'user' => ['name' => 'Taylor', 'address' => ['city' => 'Dallas']],
        ], $array);

        $array = LarArr::dot(['user' => ['name' => 'Taylor']], 'prefix.', 1);
        $this->assertSame(['prefix.user.name' => 'Taylor'], $array);
    }
}
