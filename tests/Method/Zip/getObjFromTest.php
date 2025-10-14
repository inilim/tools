<?php

namespace Inilim\Tool\Test\Method\Zip;

use Inilim\Tool\ID;
use Inilim\Tool\VD;
use Inilim\Tool\Zip;
use Inilim\Tool\Test\TestCase;
use Symfony\Component\Finder\Finder;

/**
 * TODO доделать
 * TODO почему-то не работают датапровайдеры
 */
class getObjFromTest extends TestCase
{
    function __construct()
    {
        if (!\defined('TEST_DIR_FILES')) {
            \define('TEST_DIR_FILES', \realpath(__DIR__ . '/../../../tests/files'));
        }
        parent::__construct();
    }

    function test1()
    {
        // not exist file
        $this->assertNull(Zip::getObjFrom(__DIR__ . '/' . ID::uuidv7()));
    }
    function test2()
    {
        // zip not link to file
        $this->assertNull(Zip::getObjFrom(new \ZipArchive));
    }
    function test3()
    {
        // bad object
        $this->assertNull(Zip::getObjFrom(new \stdClass));
    }
    function test4()
    {
        // bad value
        $this->assertNull(Zip::getObjFrom(''));
    }
    function test5()
    {
        // bad value
        $this->assertNull(Zip::getObjFrom(null));
    }

    /**
     * @dataProvider dataZip
     * @dataProvider dataXls
     * @dataProvider dataXlsx
     */
    // function test($file)
    // {
    //     $zip = Zip::getObjFrom($file);
    //     $this->assertInstanceOf(\ZipArchive::class, $zip);
    //     $this->assertSame(true, $zip->filename !== '');
    // }

    static function dataZip()
    {
        $finder = (new Finder)->files()->in(\TEST_DIR_FILES . '/zip')->name('*.zip');
        foreach ($finder as $file => $_) {
            yield [$file];
        }
    }
    static function dataXlsx()
    {
        $finder = (new Finder)->files()->in(\TEST_DIR_FILES . '/xlsx')->name('*.xlsx');
        foreach ($finder as $file => $_) {
            yield [$file];
        }
    }
    static function dataXls()
    {
        $finder = (new Finder)->files()->in(\TEST_DIR_FILES . '/xls')->name('*.xls');
        foreach ($finder as $file => $_) {
            yield [$file];
        }
    }
}
