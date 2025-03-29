<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class titleTest extends TestCase
{
    function testStringTitle()
    {
        $this->assertSame('Jefferson Costella', Str::title('jefferson costella'));
        $this->assertSame('Jefferson Costella', Str::title('jefFErson coSTella'));

        $this->assertSame('', Str::title(''));
        $this->assertSame('123 Explosion', Str::title('123 explosion'));
        $this->assertSame('❤Explosion', Str::title('❤explosion'));
        $this->assertSame('Explosion ❤', Str::title('explosion ❤'));
        $this->assertSame('Explosion123', Str::title('explosion123'));
        $this->assertSame('Explosion123', Str::title('Explosion123'));

        $longString = 'lorem ipsum ' . str_repeat('dolor sit amet ', 1000);
        $expectedResult = 'Lorem Ipsum Dolor Sit Amet ' . str_repeat('Dolor Sit Amet ', 999);
        $this->assertSame($expectedResult, Str::title($longString));
    }
}
