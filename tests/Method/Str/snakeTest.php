<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class snakeTest extends TestCase
{
    function test()
    {
        $this->assertSame('explosion_p_h_p_tools', Str::snake('ExplosionPHPTools'));
        $this->assertSame('explosion_php_tools', Str::snake('ExplosionPhpTools'));
        $this->assertSame('explosion php tools', Str::snake('ExplosionPhpTools', ' '));
        $this->assertSame('explosion_php_tools', Str::snake('Explosion Php Tools'));
        $this->assertSame('explosion_php_tools', Str::snake('Explosion    Php      Tools   '));
        // ensure cache keys don't overlap
        $this->assertSame('explosion__php__tools', Str::snake('ExplosionPhpTools', '__'));
        $this->assertSame('explosion_php_tools_', Str::snake('ExplosionPhpTools_', '_'));
        $this->assertSame('explosion_php_tools', Str::snake('explosion php Tools'));
        $this->assertSame('explosion_php_frame_work', Str::snake('explosion php FrameWork'));
        // prevent breaking changes
        $this->assertSame('foo-bar', Str::snake('foo-bar'));
        $this->assertSame('foo-_bar', Str::snake('Foo-Bar'));
        $this->assertSame('foo__bar', Str::snake('Foo_Bar'));
        $this->assertSame('żółtałódka', Str::snake('ŻółtaŁódka'));
    }
}
