<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class chopStartTest extends TestCase
{
    function test()
    {
        foreach (
            [
                ['http://explosion.com', 'http://', 'explosion.com'],
                ['http://-http://', 'http://', '-http://'],
                ['http://explosion.com', 'htp:/', 'http://explosion.com'],
                ['http://explosion.com', 'http://www.', 'http://explosion.com'],
                ['http://explosion.com', '-http://', 'http://explosion.com'],
                ['http://explosion.com', ['https://', 'http://'], 'explosion.com'],
                ['http://www.explosion.com', ['http://', 'www.'], 'www.explosion.com'],
                ['http://http-is-fun.test', 'http://', 'http-is-fun.test'],
                ['🌊✋', '🌊', '✋'],
                ['🌊✋', '✋', '🌊✋'],
            ] as $value
        ) {
            [$subject, $needle, $expected] = $value;

            $this->assertSame($expected, Str::chopStart($subject, $needle));
        }
    }
}
