<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class parseCallbackTest extends TestCase
{
    function test()
    {
        $this->assertEquals(['Class', 'method'], Str::parseCallback('Class@method'));
        $this->assertEquals(['Class', 'method'], Str::parseCallback('Class@method', 'foo'));
        $this->assertEquals(['Class', 'foo'], Str::parseCallback('Class', 'foo'));
        $this->assertEquals(['Class', null], Str::parseCallback('Class'));

        $this->assertEquals(["Class@anonymous\0/explosion/382.php:8$2ec", 'method'], Str::parseCallback("Class@anonymous\0/explosion/382.php:8$2ec@method"));
        $this->assertEquals(["Class@anonymous\0/explosion/382.php:8$2ec", 'method'], Str::parseCallback("Class@anonymous\0/explosion/382.php:8$2ec@method", 'foo'));
        $this->assertEquals(["Class@anonymous\0/explosion/382.php:8$2ec", 'foo'], Str::parseCallback("Class@anonymous\0/explosion/382.php:8$2ec", 'foo'));
        $this->assertEquals(["Class@anonymous\0/explosion/382.php:8$2ec", null], Str::parseCallback("Class@anonymous\0/explosion/382.php:8$2ec"));
    }
}
