<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class positionTest extends TestCase
{
    function test()
    {
        $this->assertSame(7, Str::position('Hello, World!', 'W'));
        $this->assertSame(10, Str::position('This is a test string.', 'test'));
        $this->assertSame(23, Str::position('This is a test string, test again.', 'test', 15));
        $this->assertSame(0, Str::position('Hello, World!', 'Hello'));
        $this->assertSame(7, Str::position('Hello, World!', 'World!'));
        $this->assertSame(10, Str::position('This is a tEsT string.', 'tEsT', 0, 'UTF-8'));
        $this->assertSame(7, Str::position('Hello, World!', 'W', -6));
        $this->assertSame(18, Str::position('Äpfel, Birnen und Kirschen', 'Kirschen', -10, 'UTF-8'));
        $this->assertSame(9, Str::position('@%€/=!"][$', '$', 0, 'UTF-8'));
        $this->assertFalse(Str::position('Hello, World!', 'w', 0, 'UTF-8'));
        $this->assertFalse(Str::position('Hello, World!', 'X', 0, 'UTF-8'));
        $this->assertFalse(Str::position('', 'test'));
        $this->assertFalse(Str::position('Hello, World!', 'X'));
    }
}
