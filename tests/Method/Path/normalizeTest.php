<?php

declare(strict_types=1);

use Inilim\Tool\Path;
use Inilim\Tool\Test\TestCase;

class normalizeTest extends TestCase
{
    function test()
    {
        $this->assertSame('dir/../dir/file.ext', Path::normalize('dir/..\\\\dir/////file.ext'));
        $this->assertSame('/', Path::normalize('/'));
        $this->assertSame('/', Path::normalize('//'));
        $this->assertSame('a/a/a/', Path::normalize('a//a//a//'));
        $this->assertSame('a/a/a', Path::normalize('a//a//a'));
        $this->assertSame('/a/a/a', Path::normalize('/a/a//a'));
        $this->assertSame('/a/a/a', Path::normalize('\a\a\a'));
        $this->assertSame('/a/a/a', Path::normalize('\/a//a//a'));
        $this->assertSame('/a/a/', Path::normalize('///a///a///'));
        $this->assertSame('D:/', Path::normalize('d://'));
        $this->assertSame('D:/a/a', Path::normalize('d:/a/a'));
        $this->assertSame('/a/a/a/index.php', Path::normalize('/a/a//a/index.php'));
    }
}
