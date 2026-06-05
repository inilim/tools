<?php

namespace Inilim\Tool\Test\Method\Obj;

use Inilim\Tool\Obj;

/**
 */
class getCollectionThrowableTest extends \Inilim\Tool\Test\TestCase
{
    function test()
    {
        $message = \uniqid();
        $code = \mt_rand(1, 999);
        $line = \mt_rand(1, 999);
        $file = __FILE__;
        $prev = new \Exception;
        $e = Obj::getCollectionThrowable($message, $code, $line, $file, $prev);

        $this->assertSame($code, $e->getCode());
        $this->assertSame($message, $e->getMessage());
        $this->assertSame($file, $e->getFile());
        $this->assertSame($line, $e->getLine());
        $this->assertSame($prev, $e->getPrevious());
        $iterator = $e->getIterator();
        $this->assertTrue($iterator instanceof \Generator);

        $arr = [];
        $arr[] = $e[] = new \Exception;
        $arr[] = $e[] = new \Exception;
        $arr[5] = $e[5] = new \Exception;
        $arr['key'] = $e['key'] = new \Exception;
        $e['remove'] = new \Exception;

        // true
        $this->assertTrue($e[0] instanceof \Throwable);
        $this->assertTrue($e[1] instanceof \Throwable);
        $this->assertTrue($e[5] instanceof \Throwable);
        $this->assertTrue($e['key'] instanceof \Throwable);
        $this->assertTrue(isset($e[0]));
        $this->assertTrue(isset($e[1]));
        $this->assertTrue(isset($e[5]));
        $this->assertTrue(isset($e['key']));
        // false
        $this->assertFalse(isset($e[2]));
        $this->assertFalse(isset($e[6]));

        // unset
        $this->assertTrue(isset($e['remove']));
        unset($e['remove']);
        $this->assertFalse(isset($e['remove']));

        $this->assertSame(4, \count($e));

        $this->assertSame($arr, \iterator_to_array($e, true));
    }

    /**
     * @dataProvider data_1
     */
    function test_type_1($value)
    {
        $e = Obj::getCollectionThrowable();

        $this->expectException(\InvalidArgumentException::class);

        $e[] = $value;
    }

    function data_1()
    {
        return [
            [''],
            [1],
            [1.1],
            [null],
            [true],
            [false],
            [[]],
            [new \stdClass],
        ];
    }
}
