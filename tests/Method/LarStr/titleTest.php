<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class titleTest extends TestCase
{
    function test()
    {
        $this->assertSame('Jefferson Costella', LarStr::title('jefferson costella'));
        $this->assertSame('Jefferson Costella', LarStr::title('jefFErson coSTella'));

        $this->assertSame('', LarStr::title(''));
        $this->assertSame('123 Laravel', LarStr::title('123 laravel'));
        $this->assertSame('❤Laravel', LarStr::title('❤laravel'));
        $this->assertSame('Laravel ❤', LarStr::title('laravel ❤'));
        $this->assertSame('Laravel123', LarStr::title('laravel123'));
        $this->assertSame('Laravel123', LarStr::title('Laravel123'));

        $longString = 'lorem ipsum ' . \str_repeat('dolor sit amet ', 1000);
        $expectedResult = 'Lorem Ipsum Dolor Sit Amet ' . \str_repeat('Dolor Sit Amet ', 999);
        $this->assertSame($expectedResult, LarStr::title($longString));
    }
}
