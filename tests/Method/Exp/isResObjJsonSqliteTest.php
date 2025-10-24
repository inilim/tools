<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\FS;
use Inilim\Tool\Exp;
use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;

/**
 * TODO нужно еще тесты
 */
class isResObjJsonSqliteTest extends TestCase
{
    function test()
    {
        $res = \tmpfile();
        \fwrite($res, '{"x":35}');
        $ptf = \stream_get_meta_data($res)['uri'];

        // 

        $object = Exp::openJsonViaSqlite($res);
        $this->assertTrue(Exp::isResObjJsonSqlite($object));

        // 

        \fclose($res);
        FS::unlink($ptf);
        Exp::closeResObjJsonSqlite($object);
    }

    function testChangeObject()
    {
        $res = \tmpfile();
        \fwrite($res, '{"x":35}');
        $ptf = \stream_get_meta_data($res)['uri'];

        // 

        $object = Exp::openJsonViaSqlite($res);
        Other::bindAndCall($object, function () {
            $this->tag = '';
        });
        $this->assertFalse(Exp::isResObjJsonSqlite($object));

        // 

        \fclose($res);
        FS::unlink($ptf);
        Exp::closeResObjJsonSqlite($object);
    }

    function testCloseObject()
    {
        $res = \tmpfile();
        \fwrite($res, '{"x":35}');
        $ptf = \stream_get_meta_data($res)['uri'];

        // 

        $object = Exp::openJsonViaSqlite($res);
        $this->assertTrue(Exp::isResObjJsonSqlite($object));
        Exp::closeResObjJsonSqlite($object);
        $this->assertFalse(Exp::isResObjJsonSqlite($object));

        // 

        \fclose($res);
        FS::unlink($ptf);
        Exp::closeResObjJsonSqlite($object);
    }
}
