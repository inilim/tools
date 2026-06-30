<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class dotTest extends TestCase
{
    function test()
    {
        $array = Arr::dot(['foo' => ['bar' => 'baz']]);
        $this->assertSame(['foo.bar' => 'baz'], $array);

        $array = Arr::dot([10 => 100]);
        $this->assertSame([10 => 100], $array);

        $array = Arr::dot(['foo' => [10 => 100]]);
        $this->assertSame(['foo.10' => 100], $array);

        $array = Arr::dot([]);
        $this->assertSame([], $array);

        $array = Arr::dot(['foo' => []]);
        $this->assertSame(['foo' => []], $array);

        $array = Arr::dot(['foo' => ['bar' => []]]);
        $this->assertSame(['foo.bar' => []], $array);

        $array = Arr::dot(['name' => 'taylor', 'languages' => ['php' => true]]);
        $this->assertSame(['name' => 'taylor', 'languages.php' => true], $array);

        $array = Arr::dot(['user' => ['name' => 'Taylor', 'age' => 25, 'languages' => ['PHP', 'C#']]]);
        $this->assertSame([
            'user.name' => 'Taylor',
            'user.age' => 25,
            'user.languages.0' => 'PHP',
            'user.languages.1' => 'C#',
        ], $array);

        $array = Arr::dot(['foo', 'foo' => ['bar' => 'baz', 'baz' => ['a' => 'b']]]);
        $this->assertSame([
            'foo',
            'foo.bar' => 'baz',
            'foo.baz.a' => 'b',
        ], $array);

        $array = Arr::dot(['foo' => 'bar', 'empty_array' => [], 'user' => ['name' => 'Taylor'], 'key' => 'value']);
        $this->assertSame([
            'foo' => 'bar',
            'empty_array' => [],
            'user.name' => 'Taylor',
            'key' => 'value',
        ], $array);
    }
}
