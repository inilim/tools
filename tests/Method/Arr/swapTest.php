<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class swapTest extends TestCase
{
    function test()
    {
        $array = [
            'foo' => 'is',
            'bar' => 'Laravel',
            'baz' => 'the',
            17 => 'framework',
            'qux' => 'PHP',
            23 => 'best',
        ];

        Arr::swap()($array, 'foo', 'bar');
        Arr::swap()($array, 23, 17);

        $this->assertEquals($array['foo'], 'Laravel');
        $this->assertEquals($array['bar'], 'is');
        $this->assertEquals($array['baz'], 'the');
        $this->assertEquals($array[17], 'best');
        $this->assertEquals($array['qux'], 'PHP');
        $this->assertEquals($array[23], 'framework');
    }
}
