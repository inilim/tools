<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class afterLastTest extends TestCase
{
    function test()
    {
        $this->assertSame('tte', Str::afterLast('yvette', 'yve'));
        $this->assertSame('e', Str::afterLast('yvette', 't'));
        $this->assertSame('e', Str::afterLast('ééé yvette', 't'));
        $this->assertSame('', Str::afterLast('yvette', 'tte'));
        $this->assertSame('yvette', Str::afterLast('yvette', 'xxxx'));
        $this->assertSame('yvette', Str::afterLast('yvette', ''));
        $this->assertSame('te', Str::afterLast('yv0et0te', '0'));
        $this->assertSame('te', Str::afterLast('yv0et0te', 0));
        $this->assertSame('te', Str::afterLast('yv2et2te', 2));
        $this->assertSame('foo', Str::afterLast('----foo', '---'));
    }
}
