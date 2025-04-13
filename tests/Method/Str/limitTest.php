<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class limitTest extends TestCase
{
    function test()
    {
        $this->assertSame('Laravel is...', Str::limit('Laravel is a free, open source PHP web application framework.', 10));
        $this->assertSame('这是一...', Str::limit('这是一段中文', 6));
        $this->assertSame('Laravel is a...', Str::limit('Laravel is a free, open source PHP web application framework.', 15, '...', true));

        $string = 'The PHP framework for web artisans.';
        $this->assertSame('The PHP...', Str::limit($string, 7));
        $this->assertSame('The PHP...', Str::limit($string, 10, '...', true));
        $this->assertSame('The PHP', Str::limit($string, 7, ''));
        $this->assertSame('The PHP', Str::limit($string, 10, '', true));
        $this->assertSame('The PHP framework for web artisans.', Str::limit($string, 100));
        $this->assertSame('The PHP framework for web artisans.', Str::limit($string, 100, '...', true));
        $this->assertSame('The PHP framework...', Str::limit($string, 20, '...', true));

        $nonAsciiString = '这是一段中文';
        $this->assertSame('这是一...', Str::limit($nonAsciiString, 6));
        $this->assertSame('这是一...', Str::limit($nonAsciiString, 6, '...', true));
        $this->assertSame('这是一', Str::limit($nonAsciiString, 6, ''));
        $this->assertSame('这是一', Str::limit($nonAsciiString, 6, '', true));
    }
}
