<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class isMatchTest extends TestCase
{
    function test()
    {
        $this->assertTrue(Str::isMatch('/.*,.*!/', 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch('/^.*$(.*)/', 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch('/explosion/i', 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch('/^(.*(.*(.*)))/', 'Hello, Explosion!'));

        $this->assertFalse(Str::isMatch('/H.o/', 'Hello, Explosion!'));
        $this->assertFalse(Str::isMatch('/^explosion!/i', 'Hello, Explosion!'));
        $this->assertFalse(Str::isMatch('/explosion!(.*)/', 'Hello, Explosion!'));
        $this->assertFalse(Str::isMatch('/^[a-zA-Z,!]+$/', 'Hello, Explosion!'));

        $this->assertTrue(Str::isMatch(['/.*,.*!/', '/H.o/'], 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch(['/^explosion!/i', '/^.*$(.*)/'], 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch(['/explosion/i', '/explosion!(.*)/'], 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch(['/^[a-zA-Z,!]+$/', '/^(.*(.*(.*)))/'], 'Hello, Explosion!'));
    }
}
