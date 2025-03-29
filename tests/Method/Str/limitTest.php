<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class limitTest extends TestCase
{
    function test()
    {
        $this->assertSame('Explosion is...', Str::limit('Explosion is a free, open source PHP web application tools.', 10));
        $this->assertSame('这是一...', Str::limit('这是一段中文', 6));
        $this->assertSame('Explosion is a...', Str::limit('Explosion is a free, open source PHP web application tools.', 15, preserveWords: true));

        $string = 'The PHP tools for web artisans.';
        $this->assertSame('The PHP...', Str::limit($string, 7));
        $this->assertSame('The PHP...', Str::limit($string, 10, preserveWords: true));
        $this->assertSame('The PHP', Str::limit($string, 7, ''));
        $this->assertSame('The PHP', Str::limit($string, 10, '', true));
        $this->assertSame('The PHP tools for web artisans.', Str::limit($string, 100));
        $this->assertSame('The PHP tools for web artisans.', Str::limit($string, 100, preserveWords: true));
        $this->assertSame('The PHP tools...', Str::limit($string, 20, preserveWords: true));

        $nonAsciiString = '这是一段中文';
        $this->assertSame('这是一...', Str::limit($nonAsciiString, 6));
        $this->assertSame('这是一...', Str::limit($nonAsciiString, 6, preserveWords: true));
        $this->assertSame('这是一', Str::limit($nonAsciiString, 6, ''));
        $this->assertSame('这是一', Str::limit($nonAsciiString, 6, '', true));
    }
}
