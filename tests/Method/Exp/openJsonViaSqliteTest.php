<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\FS;
use Inilim\Tool\Exp;
use Inilim\Tool\Other;
use org\bovigo\vfs\vfsStream;
use Inilim\Tool\Test\TestCase;

/**
 * TODO нужно еще тесты
 */
class openJsonViaSqliteTest extends TestCase
{
    function testResourceBrokenJson()
    {
        $res = \tmpfile();
        \fwrite($res, '{"x":35');
        $ptf = \stream_get_meta_data($res)['uri'];
        Other::errorClearLast();
        $this->assertNull(Exp::openJsonViaSqlite($res));
        $this->assertTrue(\is_array(Other::errorGetLast()));
        $this->assertStringContainsString('JSON', Other::errorGetLast()['message']);
        \fclose($res);
        FS::unlink($ptf);
    }

    function testFileBrokenJson()
    {
        $res = \tmpfile();
        \fwrite($res, '{"x":35');
        $ptf = \stream_get_meta_data($res)['uri'];
        Other::errorClearLast();
        $this->assertNull(Exp::openJsonViaSqlite($ptf));
        $this->assertTrue(\is_array(Other::errorGetLast()));
        $this->assertStringContainsString('JSON', Other::errorGetLast()['message']);
        \fclose($res);
        FS::unlink($ptf);
    }

    function testFileValidJson()
    {
        $res = \tmpfile();
        \fwrite($res, '{"x":35}');
        $ptf = \stream_get_meta_data($res)['uri'];
        // 
        Other::errorClearLast();
        $object = Exp::openJsonViaSqlite($ptf);
        $this->assertTrue(\is_object($object));
        $this->assertTrue(Exp::isResObjJsonSqlite($object));
        $this->assertNull(Other::errorGetLast());

        // PDO
        $pdo = Other::bindAndCall($object, function () {
            return $this->pdo ?? null;
        });
        $this->assertInstanceOf(\PDO::class, $pdo);
        unset($pdo);

        // File
        $sqlite = Other::bindAndCall($object, function () {
            return $this->tmpFile ?? null;
        });
        $this->assertTrue(\is_string($sqlite));
        \clearstatcache(false, $sqlite);
        $this->assertTrue(\is_file($sqlite));

        // 
        \fclose($res);
        FS::unlink($ptf);
        Exp::closeResObjJsonSqlite($object);
    }

    function testResourceValidJson()
    {

        $res = \tmpfile();
        \fwrite($res, '{"x":35}');
        $ptf = \stream_get_meta_data($res)['uri'];
        // 
        Other::errorClearLast();
        $object = Exp::openJsonViaSqlite($res);
        $this->assertTrue(\is_object($object));
        $this->assertTrue(Exp::isResObjJsonSqlite($object));
        $this->assertNull(Other::errorGetLast());

        // PDO
        $pdo = Other::bindAndCall($object, function () {
            return $this->pdo ?? null;
        });
        $this->assertInstanceOf(\PDO::class, $pdo);
        unset($pdo);

        // File
        $sqlite = Other::bindAndCall($object, function () {
            return $this->tmpFile ?? null;
        });
        $this->assertTrue(\is_string($sqlite));
        \clearstatcache(false, $sqlite);
        $this->assertTrue(\is_file($sqlite));

        // 
        \fclose($res);
        FS::unlink($ptf);
        Exp::closeResObjJsonSqlite($object);
    }

    function testExc()
    {
        $this->expectException(\InvalidArgumentException::class);
        Exp::openJsonViaSqlite('not found file');
    }

    function testExc2()
    {
        $this->expectException(\InvalidArgumentException::class);
        Exp::openJsonViaSqlite(\fopen('php://temp', 'r+'));
    }

    function testExc3()
    {
        $this->expectException(\InvalidArgumentException::class);
        Exp::openJsonViaSqlite(null);
    }
}
