<?php

namespace Inilim\Tool\Test\Method\Json;

use Inilim\Tool\Json;
use Inilim\Tool\Test\TestCase;

/**
 * TODO need more tests
 */
class getLastErrorMsgTest extends TestCase
{
    function test()
    {

        \json_decode("\xB1\x31");
        $this->assertSame(\json_last_error_msg(), Json::getLastErrorMsg());
        \json_decode('""'); // clear

        \json_decode("{'Organization': 'PHP Documentation Team'}");
        $this->assertSame(\json_last_error_msg(), Json::getLastErrorMsg());
        \json_decode('""'); // clear

        \json_decode('');
        $this->assertSame(\json_last_error_msg(), Json::getLastErrorMsg());
        \json_decode('""'); // clear

        \json_decode('[');
        $this->assertSame(\json_last_error_msg(), Json::getLastErrorMsg());
        \json_decode('""'); // clear

        \json_decode('{');
        $this->assertSame(\json_last_error_msg(), Json::getLastErrorMsg());
        \json_decode('""'); // clear


        \json_decode('""');
        $this->assertSame(\json_last_error_msg(), Json::getLastErrorMsg());
        \json_decode('""'); // clear

        \json_decode('[]');
        $this->assertSame(\json_last_error_msg(), Json::getLastErrorMsg());
        \json_decode('""'); // clear

        \json_decode('{}');
        $this->assertSame(\json_last_error_msg(), Json::getLastErrorMsg());
        \json_decode('""'); // clear
    }
}
