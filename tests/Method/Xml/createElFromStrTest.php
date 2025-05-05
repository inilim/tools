<?php

namespace Inilim\Tool\Test\Method\Xml;

use Inilim\Tool\Xml;
use Inilim\Tool\Test\TestCase;

/**
 * @group inactive
 */
class createElFromStrTest extends TestCase
{
    function testReturnEmptyHtml()
    {
        $el = Xml::createElFromStr('Word');
        $this->assertEmpty($el->ownerDocument->saveHTML($el));
    }

    function testReturnNotEmptyHtml()
    {
        $el = Xml::createElFromStr('<field/>');
        $this->assertSame('<field/>', $el->ownerDocument->saveHTML($el));
    }

    /**
     * @dataProvider data
     */
    function test($string)
    {
        $this->assertInstanceOf(\DOMDocumentFragment::class, Xml::createElFromStr($string));
    }

    static function data()
    {
        return [
            ['field'],
            ['<field/>'],
            ['<field></field>'],
        ];
    }

    /**
     * @dataProvider dataException
     */
    function testException($string)
    {
        $this->expectException(\DOMException::class);
        Xml::createElFromStr($string);
    }

    static function dataException()
    {
        return [
            ['<field>'],
            ['</field>'],
            ['<field><field>'],
            ['<field'],
            ['<<field>>'],
            // ['field>'],
        ];
    }
}
