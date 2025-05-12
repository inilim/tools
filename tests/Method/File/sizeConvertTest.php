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
        $this->assertSame('1 KB', File::sizeConvert(1000));
        $this->assertSame('2 KB', File::sizeConvert(2000));
        $this->assertSame('2.00 KB', File::sizeConvert(2000, 2));
        $this->assertSame('1.23 KB', File::sizeConvert(1234, 2));
        $this->assertSame('1.234 KB', File::sizeConvert(1234, 0, 3));
        $this->assertSame('1.234 KB', File::sizeConvert(1234, 3));
        $this->assertSame('5 GB', File::sizeConvert(1000 * 1000 * 1000 * 5));
        $this->assertSame('10 TB', File::sizeConvert((1000 ** 4) * 10));
        $this->assertSame('10 PB', File::sizeConvert((1000 ** 5) * 10));
        $this->assertSame('1 ZB', File::sizeConvert(1000 ** 7));
        $this->assertSame('1 YB', File::sizeConvert(1000 ** 8));
        $this->assertSame('1 RB', File::sizeConvert(1000 ** 9));
        $this->assertSame('1 QB', File::sizeConvert(1000 ** 10));
        $this->assertSame('1,000 QB', File::sizeConvert(1000 ** 11));

        $this->assertSame('0 B', File::sizeConvert(0, 0, null, true));
        $this->assertSame('0.00 B', File::sizeConvert(0, 2, null, true));
        $this->assertSame('1 B', File::sizeConvert(1, 0, null, true));
        $this->assertSame('1 KiB', File::sizeConvert(1024, 0, null, true));
        $this->assertSame('2 KiB', File::sizeConvert(2048, 0, null, true));
        $this->assertSame('2.00 KiB', File::sizeConvert(2048, 2, null, true));
        $this->assertSame('1.23 KiB', File::sizeConvert(1264, 2, null, true));
        $this->assertSame('1.234 KiB', File::sizeConvert(1264.12345, 0, 3, true));
        $this->assertSame('1.234 KiB', File::sizeConvert(1264, 3, null, true));
        $this->assertSame('5 GiB', File::sizeConvert(1024 * 1024 * 1024 * 5, 0, null, true));
        $this->assertSame('10 TiB', File::sizeConvert((1024 ** 4) * 10, 0, null, true));
        $this->assertSame('10 PiB', File::sizeConvert((1024 ** 5) * 10, 0, null, true));
        $this->assertSame('1 ZiB', File::sizeConvert(1024 ** 7, 0, null, true));
        $this->assertSame('1 YiB', File::sizeConvert(1024 ** 8, 0, null, true));
        $this->assertSame('1 RiB', File::sizeConvert(1024 ** 9, 0, null, true));
        $this->assertSame('1 QiB', File::sizeConvert(1024 ** 10, 0, null, true));
        $this->assertSame('1,024 QiB', File::sizeConvert(1024 ** 11, 0, null, true));
    }
}
