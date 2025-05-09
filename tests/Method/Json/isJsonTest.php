<?php

namespace Inilim\Tool\Test\Method\Json;

use Inilim\Tool\Json;
use Inilim\Tool\Test\TestCase;

class isJsonTest extends TestCase
{
    function test()
    {
        $this->assertTrue(Json::isJson('1'));
        $this->assertTrue(Json::isJson('[1,2,3]'));
        $this->assertTrue(Json::isJson('[1,   2,   3]'));
        $this->assertTrue(Json::isJson('{"first": "John", "last": "Doe"}'));
        $this->assertTrue(Json::isJson('[{"first": "John", "last": "Doe"}, {"first": "Jane", "last": "Doe"}]'));

        $this->assertFalse(Json::isJson('1,'));
        $this->assertFalse(Json::isJson('[1,2,3'));
        $this->assertFalse(Json::isJson('[1,   2   3]'));
        $this->assertFalse(Json::isJson('{first: "John"}'));
        $this->assertFalse(Json::isJson('[{first: "John"}, {first: "Jane"}]'));
        $this->assertFalse(Json::isJson(''));
        $this->assertFalse(Json::isJson(null));
        // $this->assertFalse(Json::isJson([]));
    }

    function testAlias()
    {
        $this->assertTrue(Json::is('1'));
        $this->assertTrue(Json::is('[1,2,3]'));
        $this->assertTrue(Json::is('[1,   2,   3]'));
        $this->assertTrue(Json::is('{"first": "John", "last": "Doe"}'));
        $this->assertTrue(Json::is('[{"first": "John", "last": "Doe"}, {"first": "Jane", "last": "Doe"}]'));

        $this->assertFalse(Json::is('1,'));
        $this->assertFalse(Json::is('[1,2,3'));
        $this->assertFalse(Json::is('[1,   2   3]'));
        $this->assertFalse(Json::is('{first: "John"}'));
        $this->assertFalse(Json::is('[{first: "John"}, {first: "Jane"}]'));
        $this->assertFalse(Json::is(''));
        $this->assertFalse(Json::is(null));
    }
}
