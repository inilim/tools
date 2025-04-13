<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class substrReplaceTest extends TestCase
{
    function test()
    {
        $this->assertSame('12:00', Str::substrReplace('1200', ':', 2, 0));
        $this->assertSame('The Laravel Framework', Str::substrReplace('The Framework', 'Laravel ', 4, 0));
        $this->assertSame('Laravel – The PHP Framework for Web Artisans', Str::substrReplace('Laravel Framework', '– The PHP Framework for Web Artisans', 8));
    }
}
