<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class initialsTest extends TestCase
{
    function test()
    {
        $this->assertSame('jb', LarStr::initials('james bond'));
        $this->assertSame('jb', LarStr::initials(' james bond'));
        $this->assertSame('jb', LarStr::initials('james  bond'));

        $this->assertSame('JB', LarStr::initials('James Bond'));

        $this->assertSame('JB', LarStr::initials('james bond', true));

        $this->assertSame('JBLL', LarStr::initials('james bond loves laravel', true));

        $this->assertSame('❤M☆', LarStr::initials('❤ MULTIByte ☆'));

        $this->assertSame('lr', LarStr::initials('laravel rocks!'));
        $this->assertSame('LR', LarStr::initials('laravel rocks!', true));
    }
}
