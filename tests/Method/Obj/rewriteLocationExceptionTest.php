<?php

namespace Inilim\Tool\Test\Method\Obj;

use Inilim\Tool\Obj;
use Inilim\Tool\Test\CasePhpT;
use Inilim\Tool\Test\TestProcess;

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

    function testPhpVer()
    {
        $dir = CasePhpT::self()->getDir([Obj::class, 'rewriteLocationException']);
        $case = $dir . '/case_1.php';
        foreach (['7.4', '8.0', '8.1', '8.2', '8.3', '8.4'] as $php) {
            $asserts = (new TestProcess($case))->withPhp($php)->run();
            foreach ($asserts as $assert) {
                $this->assertTag($assert);
            }
        }
    }
}
