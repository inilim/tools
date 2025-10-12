<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\ID;
use Inilim\Tool\Exp;
use Inilim\Tool\Test\CasePhpT;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\TestProcess;
use Symfony\Component\Finder\Finder;

/**
 * TODO доделать
 */
class excelGetSheetsInfoTest extends TestCase
{
    function test11()
    {
        $files = new Finder;
        $files->files()->in($this->getDirFiles())->name(['*.xlsx']);
        foreach (CasePhpT::self()->cases([Exp::class, 'excelGetSheetsInfo']) as $case) {
            foreach ($files as $file => $_) {
                foreach (['7.4', '8.2', '8.4'] as $php) {
                    $asserts = (new TestProcess($case))->withPhp($php)->withEnv('file', $file)->run();
                    foreach ($asserts as $assert) {
                        $this->assertTag($assert);
                    }
                }
            }
        }
    }

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
