<?php

declare(strict_types=1);

use Inilim\Tool\Other;

class getTypeTest extends \Inilim\Tool\Test\TestCase
{
    function test()
    {
        // without $trueFalseAsSeparateType = false
        $this->assertSame('null', Other::getType(null));
        $this->assertSame('string', Other::getType(''));
        $this->assertSame('string', Other::getType('string'));
        $this->assertSame('int', Other::getType(1));
        $this->assertSame('int', Other::getType(-1));
        $this->assertSame('int', Other::getType(0));
        $this->assertSame('float', Other::getType(1.0));
        $this->assertSame('float', Other::getType(-1.0));
        $this->assertSame('bool', Other::getType(true));
        $this->assertSame('bool', Other::getType(false));
        $this->assertSame('array', Other::getType([]));
        $this->assertSame('array', Other::getType([1]));
        $this->assertSame('object', Other::getType(new \stdClass));
        $this->assertSame('exception', Other::getType(new \Exception()));
        $tmp = \tmpfile();
        $this->assertSame('resource', Other::getType($tmp));
        \fclose($tmp);
        $this->assertSame('resource_closed', Other::getType($tmp));

        // with $trueFalseAsSeparateType = true
        $this->assertSame('true', Other::getType(true, true));
        $this->assertSame('false', Other::getType(false, true));

        $this->assertSame('null', Other::getType(null, true));
        $this->assertSame('string', Other::getType('', true));
        $this->assertSame('string', Other::getType('string', true));
        $this->assertSame('int', Other::getType(1, true));
        $this->assertSame('int', Other::getType(-1, true));
        $this->assertSame('int', Other::getType(0, true));
        $this->assertSame('float', Other::getType(1.0, true));
        $this->assertSame('float', Other::getType(-1.0, true));
        $this->assertSame('array', Other::getType([], true));
        $this->assertSame('array', Other::getType([1], true));
        $this->assertSame('object', Other::getType(new \stdClass, true));
        $this->assertSame('exception', Other::getType(new \Exception(), true));
        $tmp = \tmpfile();
        $this->assertSame('resource', Other::getType($tmp, true));
        \fclose($tmp);
        $this->assertSame('resource_closed', Other::getType($tmp, true));
    }
}
