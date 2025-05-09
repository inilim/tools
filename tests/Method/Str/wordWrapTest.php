<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class wordWrapTest extends TestCase
{
    function test()
    {
        $this->assertEquals('Hello<br />World', Str::wordWrap('Hello World', 3, '<br />'));
        $this->assertEquals('Hel<br />lo<br />Wor<br />ld', Str::wordWrap('Hello World', 3, '<br />', true));

        $this->assertEquals('❤Multi<br />Byte☆❤☆❤☆❤', Str::wordWrap('❤Multi Byte☆❤☆❤☆❤', 3, '<br />'));
    }
}
