<?php

namespace Inilim\Tool\Test\Method\Check;

use Inilim\Tool\Check;
use Inilim\Tool\Test\TestCase;

class luhnNumberTest extends TestCase
{
    function testValid()
    {
        $this->assertTrue(Check::luhnNumber('2222400041240011'), '17 digits string');
        $this->assertTrue(Check::luhnNumber('340316193809364'), '16 digits string');
        $this->assertTrue(Check::luhnNumber(6011000990139424), 'integer');
    }

    function testInvalid()
    {
        $this->assertFalse(Check::luhnNumber('2222400041240021'), 'invalid string');
        $this->assertFalse(Check::luhnNumber(340316193809334), 'invalid integer');
        $this->assertFalse(Check::luhnNumber(222240004124001.1), 'float');
        $this->assertFalse(Check::luhnNumber(true), 'boolean true');
        $this->assertFalse(Check::luhnNumber(false), 'boolean false');
        $this->assertFalse(Check::luhnNumber(''), 'empty');
        $this->assertFalse(Check::luhnNumber(new \stdClass()), 'object');
        $this->assertFalse(Check::luhnNumber([2222400041240011]), 'array');
    }
}
