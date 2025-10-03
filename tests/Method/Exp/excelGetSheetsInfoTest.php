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
        $this->expectException(\InvalidArgumentException::class);
        Exp::excelGetSheetsInfo(__DIR__ . '/' . ID::uuidv7());
    }
    function test2()
    {
        $this->expectException(\InvalidArgumentException::class);
        Exp::excelGetSheetsInfo(new \ZipArchive);
    }
    function test3()
    {
        $this->expectException(\InvalidArgumentException::class);
        Exp::excelGetSheetsInfo(new \stdClass);
    }
    function test4()
    {
        $this->expectException(\InvalidArgumentException::class);
        Exp::excelGetSheetsInfo('');
    }
    function test5()
    {
        $this->expectException(\InvalidArgumentException::class);
        Exp::excelGetSheetsInfo(null);
    }
}
