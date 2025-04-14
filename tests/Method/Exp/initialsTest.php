<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\Exp;
use Inilim\Tool\Test\TestCase;

class initialsTest extends TestCase
{
    function test()
    {
        $this->assertSame('JD', Exp::initials('John Doe'));
        $this->assertSame('JD', Exp::initials('  John   Doe  '));
        $this->assertSame('J.D', Exp::initials('John Doe', '.'));

        // Single word name
        $this->assertSame('J', Exp::initials('John'));

        // Multiple spaces and special characters
        $this->assertSame('J-D', Exp::initials(' John   Doe ', '-'));
        $this->assertSame('A-B-C', Exp::initials('Alice Bob Charlie', '-'));

        // Unicode characters
        $this->assertSame('ÇÖ', Exp::initials('Çağrı Özkan'));
        $this->assertSame('ÑG', Exp::initials('Ñoño García'));

        // Non-alphabetic characters should be ignored
        $this->assertSame('J2D', Exp::initials('John 2 Doe'));
        $this->assertSame('A-B-C', Exp::initials(' Alice! Bob? Charlie.', '-'));

        // Empty string case
        $this->assertSame('', Exp::initials(''));

        // Mixed case input
        $this->assertSame('JD', Exp::initials('john doe'));
        $this->assertSame('JD', Exp::initials('JOHN DOE'));

        // multiline
        $this->assertSame('JD', Exp::initials('JOHN
        
        DOE'));
    }
}
