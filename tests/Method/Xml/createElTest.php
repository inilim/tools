<?php

namespace Inilim\Tool\Test\Method\Xml;

use Inilim\Tool\Xml;
use Inilim\Tool\Test\TestCase;

class createElTest extends TestCase
{
    function test()
    {
        $el = Xml::createEl('test');
        $this->assertInstanceOf(\DOMElement::class, $el);
        $el->setAttribute('name', 'value');
        $this->assertSame('<test name="value"></test>', $el->ownerDocument->saveHTML($el));
        $this->assertSame('<root><test name="value"></test></root>', \trim($el->ownerDocument->saveHTML()));
        $el->setAttribute('привет', 'мир');
        $this->assertSame('<test name="value" привет="мир"></test>', $el->ownerDocument->saveHTML($el));
        $this->assertSame('<root><test name="value" &#1087;&#1088;&#1080;&#1074;&#1077;&#1090;="&#1084;&#1080;&#1088;"></test></root>', \trim($el->ownerDocument->saveHTML()));
    }
}
