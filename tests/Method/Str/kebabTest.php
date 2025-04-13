<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class kebabTest extends TestCase
{
    function test()
    {
        $this->assertSame('explosion-php-tools', Str::kebab('ExplosionPhpTools'));
        $this->assertSame('explosion-php-tools', Str::kebab('Explosion Php Tools'));
        $this->assertSame('explosion❤-php-tools', Str::kebab('Explosion ❤ Php Tools'));
        $this->assertSame('', Str::kebab(''));
    }
}
