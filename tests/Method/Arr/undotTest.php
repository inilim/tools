<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class undotTest extends TestCase
{
    function test()
    {
        $array = Arr::undot([
            'user.name' => 'Taylor',
            'user.age' => 25,
            'user.languages.0' => 'PHP',
            'user.languages.1' => 'C#',
        ]);
        $this->assertEquals(['user' => ['name' => 'Taylor', 'age' => 25, 'languages' => ['PHP', 'C#']]], $array);

        $array = Arr::undot([
            'pagination.previous' => '<<',
            'pagination.next' => '>>',
        ]);
        $this->assertEquals(['pagination' => ['previous' => '<<', 'next' => '>>']], $array);

        $array = Arr::undot([
            'foo',
            'foo.bar' => 'baz',
            'foo.baz' => ['a' => 'b'],
        ]);
        $this->assertEquals(['foo', 'foo' => ['bar' => 'baz', 'baz' => ['a' => 'b']]], $array);
    }
}
