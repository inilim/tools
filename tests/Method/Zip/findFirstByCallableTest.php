<?php

namespace Inilim\Tool\Test\Method\Zip;

use Inilim\Tool\ID;
use Inilim\Tool\VD;
use Inilim\Tool\Zip;
use Inilim\Tool\Test\TestCase;

/**
 * TODO доделать
 */
class findFirstByCallableTest extends TestCase
{
    function test1()
    {
        $countCall = 0;
        $find = Zip::findFirstByCallable(\TEST_DIR_FILES . '/zip/empty.zip', static function () use (&$countCall) {
            $countCall++;
            return true;
        });

        $this->assertNull($find);
        $this->assertSame(0, $countCall);
    }
}
