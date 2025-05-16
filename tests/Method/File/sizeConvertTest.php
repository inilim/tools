<?php

namespace Inilim\Tool\Test\Method\File;

use Inilim\Tool\File;
use Inilim\Tool\Test\TestCase;

class sizeConvertTest extends TestCase
{
    function test()
    {
        $this->assertSame('0 B', File::sizeConvert(0));
        $this->assertSame('0.00 B', File::sizeConvert(0, 2));
        $this->assertSame('1 B', File::sizeConvert(1));
        $this->assertSame('1 KB', File::sizeConvert(1024));
        $this->assertSame('2 KB', File::sizeConvert(2048));
        $this->assertSame('2.00 KB', File::sizeConvert(2048, 2));
        $this->assertSame('1.23 KB', File::sizeConvert(1264, 2));
        $this->assertSame('1.234 KB', File::sizeConvert(1264.12345, 0, 3));
        $this->assertSame('1.234 KB', File::sizeConvert(1264, 3));
        $this->assertSame('5 GB', File::sizeConvert(1024 * 1024 * 1024 * 5));
        $this->assertSame('10 TB', File::sizeConvert((1024 ** 4) * 10));
        $this->assertSame('10 PB', File::sizeConvert((1024 ** 5) * 10));
        $this->assertSame('1 ZB', File::sizeConvert(1024 ** 7));
        $this->assertSame('1 YB', File::sizeConvert(1024 ** 8));
        $this->assertSame('1,024 YB', File::sizeConvert(1024 ** 9));
    }
}
