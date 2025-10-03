<?php

namespace Inilim\Tool\Test\Method\Zip;

use Inilim\Tool\ID;
use Inilim\Tool\VD;
use Inilim\Tool\Zip;
use Inilim\Tool\Test\TestCase;

/**
 * TODO доделать
 */
class scanAsGeneratorTest extends TestCase
{
    function test1()
    {
        $countCall = 0;
        foreach (Zip::scanAsGenerator(\TEST_DIR_FILES . '/zip/empty.zip') as $item) {
            $countCall++;
        }
        $this->assertSame(0, $countCall);
    }
}
