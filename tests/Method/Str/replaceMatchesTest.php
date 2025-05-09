<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class replaceMatchesTest extends TestCase
{
    function test()
    {
        // Test basic string replacement
        $this->assertSame('foo bar bar', Str::replaceMatches('/baz/', 'bar', 'foo baz bar'));
        $this->assertSame('foo baz baz', Str::replaceMatches('/404/', 'found', 'foo baz baz'));

        // Test with array of patterns
        $this->assertSame('foo XXX YYY', Str::replaceMatches(['/bar/', '/baz/'], ['XXX', 'YYY'], 'foo bar baz'));

        // Test with callback
        $result = Str::replaceMatches('/ba(.)/', function ($match) {
            return 'ba' . strtoupper($match[1]);
        }, 'foo baz bar');

        $this->assertSame('foo baZ baR', $result);

        $result = Str::replaceMatches('/(\d+)/', function ($match) {
            return $match[1] * 2;
        }, 'foo 123 bar 456');

        $this->assertSame('foo 246 bar 912', $result);

        // Test with limit parameter
        $this->assertSame('foo baz baz', Str::replaceMatches('/ba(.)/', 'ba$1', 'foo baz baz', 1));

        $result = Str::replaceMatches('/ba(.)/', function ($match) {
            return 'ba' . strtoupper($match[1]);
        }, 'foo baz baz bar', 1);

        $this->assertSame('foo baZ baz bar', $result);
    }
}
