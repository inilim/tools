<?php

namespace Inilim\Tool\Test\Method\Obj;

use Inilim\Tool\Obj;

/**
 */
class rewriteLocationExceptionTest extends \Inilim\Tool\Test\TestCase
{
    function test()
    {
        $e = new \Exception();

        Obj::rewriteLocationException($e, 'My File', 777);

        $this->assertSame('My File', $e->getFile());
        $this->assertSame(777, $e->getLine());
    }
}
