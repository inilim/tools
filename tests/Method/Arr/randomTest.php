<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class randomTest extends TestCase
{
    function test()
    {
        $random = Arr::random(['foo', 'bar', 'baz']);
        $this->assertContains($random, ['foo', 'bar', 'baz']);

        $random = Arr::random(['foo', 'bar', 'baz'], 0);
        $this->assertIsArray($random);
        $this->assertCount(0, $random);

        $random = Arr::random(['foo', 'bar', 'baz'], 1);
        $this->assertIsArray($random);
        $this->assertCount(1, $random);
        $this->assertContains($random[0], ['foo', 'bar', 'baz']);

        $random = Arr::random(['foo', 'bar', 'baz'], 2);
        $this->assertIsArray($random);
        $this->assertCount(2, $random);
        $this->assertContains($random[0], ['foo', 'bar', 'baz']);
        $this->assertContains($random[1], ['foo', 'bar', 'baz']);

        $random = Arr::random(['foo', 'bar', 'baz'], '0');
        $this->assertIsArray($random);
        $this->assertCount(0, $random);

        $random = Arr::random(['foo', 'bar', 'baz'], '1');
        $this->assertIsArray($random);
        $this->assertCount(1, $random);
        $this->assertContains($random[0], ['foo', 'bar', 'baz']);

        $random = Arr::random(['foo', 'bar', 'baz'], '2');
        $this->assertIsArray($random);
        $this->assertCount(2, $random);
        $this->assertContains($random[0], ['foo', 'bar', 'baz']);
        $this->assertContains($random[1], ['foo', 'bar', 'baz']);

        // preserve keys
        $random = Arr::random(['one' => 'foo', 'two' => 'bar', 'three' => 'baz'], 2, true);
        $this->assertIsArray($random);
        $this->assertCount(2, $random);
        $this->assertCount(2, array_intersect_assoc(['one' => 'foo', 'two' => 'bar', 'three' => 'baz'], $random));
    }

    function testRandomNotIncrementingKeys()
    {
        $random = Arr::random(['foo' => 'foo', 'bar' => 'bar', 'baz' => 'baz']);
        $this->assertContains($random, ['foo', 'bar', 'baz']);
    }

    function testRandomOnEmptyArray()
    {
        $random = Arr::random([], 0);
        $this->assertIsArray($random);
        $this->assertCount(0, $random);

        $random = Arr::random([], '0');
        $this->assertIsArray($random);
        $this->assertCount(0, $random);
    }

    function testRandomThrowsAnErrorWhenRequestingMoreItemsThanAreAvailable()
    {
        $exceptions = 0;

        try {
            Arr::random([]);
        } catch (\InvalidArgumentException $e) {
            $exceptions++;
        }

        try {
            Arr::random([], 1);
        } catch (\InvalidArgumentException $e) {
            $exceptions++;
        }

        try {
            Arr::random([], 2);
        } catch (\InvalidArgumentException $e) {
            $exceptions++;
        }

        $this->assertSame(3, $exceptions);
    }
}
