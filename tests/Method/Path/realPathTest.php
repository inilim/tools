<?php

declare(strict_types=1);

use Inilim\Tool\Path;
use Inilim\Tool\Test\TestCase;

class realPathTest extends TestCase
{
    function test()
    {
        $this->assertSame(null, Path::realPath('/a/a/a'));
        $this->assertSame(null, Path::realPath('/a/a/../a'));
        $this->assertSame(__DIR__, Path::realPath(__DIR__ . '/../' . \basename(__DIR__)));
    }
}
