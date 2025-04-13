<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class maskTest extends TestCase
{
    function test()
    {
        $this->assertSame('hel*************', Str::mask('hello@email.com', '*', 3));
        $this->assertSame('******@email.com', Str::mask('hello@email.com', '*', 0, 6));
        $this->assertSame('hel*************', Str::mask('hello@email.com', '*', -13));
        $this->assertSame('hel***@email.com', Str::mask('hello@email.com', '*', -13, 3));

        $this->assertSame('****************', Str::mask('hello@email.com', '*', -17));
        $this->assertSame('*****r@email.com', Str::mask('hello@email.com', '*', -99, 5));

        $this->assertSame('hello@email.com', Str::mask('hello@email.com', '*', 16));
        $this->assertSame('hello@email.com', Str::mask('hello@email.com', '*', 16, 99));

        $this->assertSame('hello@email.com', Str::mask('hello@email.com', '', 3));

        $this->assertSame('helsssssssssssss', Str::mask('hello@email.com', 'something', 3));

        $this->assertSame('这是一***', Str::mask('这是一段中文', '*', 3));
        $this->assertSame('**一段中文', Str::mask('这是一段中文', '*', 0, 2));

        $this->assertSame('ma*n@email.com', Str::mask('maan@email.com', '*', 2, 1));
        $this->assertSame('ma***email.com', Str::mask('maan@email.com', '*', 2, 3));
        $this->assertSame('ma************', Str::mask('maan@email.com', '*', 2));

        $this->assertSame('mari*@email.com', Str::mask('maria@email.com', '*', 4, 1));
        $this->assertSame('tamar*@email.com', Str::mask('tamara@email.com', '*', 5, 1));

        $this->assertSame('*aria@email.com', Str::mask('maria@email.com', '*', 0, 1));
        $this->assertSame('maria@email.co*', Str::mask('maria@email.com', '*', -1, 1));
        $this->assertSame('maria@email.co*', Str::mask('maria@email.com', '*', -1));
        $this->assertSame('***************', Str::mask('maria@email.com', '*', -15));
        $this->assertSame('***************', Str::mask('maria@email.com', '*', 0));
    }
}
