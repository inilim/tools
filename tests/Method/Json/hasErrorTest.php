<?php

namespace Inilim\Tool\Test\Method\Json;

use Inilim\Tool\Json;
use Inilim\Tool\Test\TestCase;

class hasErrorTest extends TestCase
{
    function test()
    {
        \json_decode('');
        $this->assertTrue(Json::hasError());
        \json_decode('""'); // clear

        \json_decode('[');
        $this->assertTrue(Json::hasError());
        \json_decode('""'); // clear

        \json_decode('{');
        $this->assertTrue(Json::hasError());
        \json_decode('""'); // clear


        \json_decode('""');
        $this->assertFalse(Json::hasError());
        \json_decode('""'); // clear

        \json_decode('[]');
        $this->assertFalse(Json::hasError());
        \json_decode('""'); // clear

        \json_decode('{}');
        $this->assertFalse(Json::hasError());
        \json_decode('""'); // clear
    }
}
