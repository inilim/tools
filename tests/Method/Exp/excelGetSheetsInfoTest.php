<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\ID;
use Inilim\Tool\Exp;
use Inilim\Tool\Test\TestCase;

/**
 * TODO доделать
 */
class excelGetSheetsInfoTest extends TestCase
{
    function test1()
    {
        $this->assertNull(Exp::excelGetSheetsInfo(__DIR__ . '/' . ID::uuidv7()));
    }
    function test2()
    {
        $this->assertNull(Exp::excelGetSheetsInfo(new \ZipArchive));
    }
    function test3()
    {
        $this->assertNull(Exp::excelGetSheetsInfo(new \stdClass));
    }
    function test4()
    {
        $this->assertNull(Exp::excelGetSheetsInfo(''));
    }
    function test5()
    {
        $this->assertNull(Exp::excelGetSheetsInfo(null));
    }
}
