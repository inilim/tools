<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\PF;
use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class partitionTest extends TestCase
{
    function test()
    {
        $array = ['John', 'Jane', 'Greg'];

        $result = Arr::partition($array, fn(string $value) => PF::str_contains($value, 'J'));

        $this->assertEquals([[0 => 'John', 1 => 'Jane'], [2 => 'Greg']], $result);
    }
}
