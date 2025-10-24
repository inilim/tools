<?php

namespace Inilim\Tool\Test\Method\Other;

use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class getPathFromResourceTest extends TestCase
{
    function test()
    {
        $pth = Other::getPathFromResource(\fopen('php://temp', 'r+'));
        $this->assertSame('php://temp', $pth);
        $res = \tmpfile();
        $pth = Other::getPathFromResource($res);
        $this->assertTrue(\is_file($pth));
        \fclose($res);
    }

    function test2()
    {
        $this->expectException(\InvalidArgumentException::class);
        Other::getPathFromResource('');
    }
}
