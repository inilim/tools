<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\FS;
use Inilim\Tool\Exp;
use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;

/**
 * TODO нужно еще тесты
 */
class closeResObjJsonSqliteTest extends TestCase
{
    function test()
    {
        $res = \tmpfile();
        \fwrite($res, '{"x":35}');
        $ptf = \stream_get_meta_data($res)['uri'];
        $object = Exp::openJsonViaSqlite($res);

        // 

        $this->assertFalse(Exp::closeResObjJsonSqlite(new \stdClass));
        $this->assertTrue(Exp::closeResObjJsonSqlite($object));
        $this->assertFalse(Exp::closeResObjJsonSqlite($object));

        // 

        \fclose($res);
        FS::unlink($ptf);
        Exp::closeResObjJsonSqlite($object);
    }
}
