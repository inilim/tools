<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class beforeLastTest extends TestCase
{
    function test()
    {
        $this->assertSame('yve', Str::beforeLast('yvette', 'tte'));
        $this->assertSame('yvet', Str::beforeLast('yvette', 't'));
        $this->assertSame('ééé ', Str::beforeLast('ééé yvette', 'yve'));
        $this->assertSame('', Str::beforeLast('yvette', 'yve'));
        $this->assertSame('yvette', Str::beforeLast('yvette', 'xxxx'));
        $this->assertSame('yvette', Str::beforeLast('yvette', ''));
        $this->assertSame('yv0et', Str::beforeLast('yv0et0te', '0'));
        $this->assertSame('yv0et', Str::beforeLast('yv0et0te', 0));
        $this->assertSame('yv2et', Str::beforeLast('yv2et2te', 2));
        $this->assertSame('', Str::beforeLast('', 'test'));
        $this->assertSame('', Str::beforeLast('yvette', 'yvette'));
        $this->assertSame('explosion', Str::beforeLast('explosion tools', ' '));
        $this->assertSame('yvette', Str::beforeLast("yvette\tyv0et0te", "\t"));
    }
}
