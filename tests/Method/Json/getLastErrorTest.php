<?php

namespace Inilim\Tool\Test\Method\Json;

use Inilim\Tool\Json;
use Inilim\Tool\Test\TestCase;

/**
 * TODO need more tests
 */
class getLastErrorTest extends TestCase
{
    function test()
    {

        \json_decode("\xB1\x31");
        $t = Json::getLastError();
        $this->assertSame(\json_last_error(), $t['code']);
        $this->assertSame(\json_last_error_msg(), $t['msg']);
        \json_decode('""'); // clear

        \json_decode("{'Organization': 'PHP Documentation Team'}");
        $t = Json::getLastError();
        $this->assertSame(\json_last_error(), $t['code']);
        $this->assertSame(\json_last_error_msg(), $t['msg']);
        \json_decode('""'); // clear

        \json_decode('');
        $t = Json::getLastError();
        $this->assertSame(\json_last_error(), $t['code']);
        $this->assertSame(\json_last_error_msg(), $t['msg']);
        \json_decode('""'); // clear

        \json_decode('[');
        $t = Json::getLastError();
        $this->assertSame(\json_last_error(), $t['code']);
        $this->assertSame(\json_last_error_msg(), $t['msg']);
        \json_decode('""'); // clear

        \json_decode('{');
        $t = Json::getLastError();
        $this->assertSame(\json_last_error(), $t['code']);
        $this->assertSame(\json_last_error_msg(), $t['msg']);
        \json_decode('""'); // clear


        \json_decode('""');
        $t = Json::getLastError();
        $this->assertSame(\json_last_error(), $t['code']);
        $this->assertSame(\json_last_error_msg(), $t['msg']);
        \json_decode('""'); // clear

        \json_decode('[]');
        $t = Json::getLastError();
        $this->assertSame(\json_last_error(), $t['code']);
        $this->assertSame(\json_last_error_msg(), $t['msg']);
        \json_decode('""'); // clear

        \json_decode('{}');
        $t = Json::getLastError();
        $this->assertSame(\json_last_error(), $t['code']);
        $this->assertSame(\json_last_error_msg(), $t['msg']);
        \json_decode('""'); // clear
    }
}
