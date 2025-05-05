<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class shuffleTest extends TestCase
{
    function testShuffleProducesDifferentShuffles()
    {
        $input = range('a', 'z');

        $this->assertFalse(
            Arr::shuffle($input) === Arr::shuffle($input) && Arr::shuffle($input) === Arr::shuffle($input),
            "The shuffles produced the same output each time, which shouldn't happen."
        );
    }

    function testShuffleActuallyShuffles()
    {
        $input = range('a', 'z');

        $this->assertFalse(
            Arr::shuffle($input) === $input && Arr::shuffle($input) === $input,
            "The shuffles were unshuffled each time, which shouldn't happen."
        );
    }

    function testShuffleKeepsSameValues()
    {
        $input = range('a', 'z');
        $shuffled = Arr::shuffle($input);
        sort($shuffled);

        $this->assertEquals($input, $shuffled);
    }

    function testEmptyShuffle()
    {
        $this->assertEquals([], Arr::shuffle([]));
    }
}
