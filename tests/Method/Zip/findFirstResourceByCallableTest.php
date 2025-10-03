<?php

namespace Inilim\Tool\Test\Method\Zip;

use Inilim\Tool\ID;
use Inilim\Tool\VD;
use Inilim\Tool\Zip;
use Inilim\Tool\Test\TestCase;

/**
 * TODO доделать
 */
class findFirstResourceByCallableTest extends TestCase
{
    function test1()
    {
        $countCall = 0;
        $find = Zip::findFirstResourceByCallable(\TEST_DIR_FILES . '/zip/empty.zip', static function () use (&$countCall) {
            $countCall++;
            return true;
        });

        $this->assertNull($find);
        $this->assertSame(0, $countCall);
    }
}
