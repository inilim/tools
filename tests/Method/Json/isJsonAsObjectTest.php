<?php

namespace Inilim\Tool\Test\Method\Json;

use Inilim\Tool\Json;
use Inilim\Tool\Test\TestCase;

class isJsonAsObjectTest extends TestCase
{
    function test()
    {
        // string(13) "string | "42""
        // string(17) "string | "string""
        // string(12) "double | 9.1"
        // string(10) "double | 1"
        // string(14) "boolean | true"
        // string(15) "boolean | false"
        // string(13) "integer | 123"
        // string(11) "NULL | null"
        // string(11) "string | """
        // string(10) "array | []"
        // string(16) "array | {"f":[]}"
        // string(15) "array | [1,2,3]"
        // string(11) "object | {}"
        // string(25) "object | {"key1":"value"}"
        // string(60) "array | [{"key1":"value"},{"key1":"value"},{"key1":"value"}]"
        // string(18) "array | [{},{},{}]"



        $this->assertTrue(Json::isJsonAsObject('{}'));
        $this->assertTrue(Json::isJsonAsObject('{"key1":"value"}'));
        $this->assertTrue(Json::isJsonAsObject('{"f":[]}'));
        $this->assertTrue(Json::isJsonAsObject(\json_encode(['key' => 1])));
        $obj = new \stdClass;
        $obj->key = 'value';
        $this->assertTrue(Json::isJsonAsObject(\json_encode(new \stdClass)));
        $this->assertTrue(Json::isJsonAsObject(\json_encode($obj)));
        // 


        $this->assertFalse(Json::isJsonAsObject(\json_encode([1, 2, 3])));
        $this->assertFalse(Json::isJsonAsObject(\json_encode(123)));
        $this->assertFalse(Json::isJsonAsObject(\json_encode(1.1)));
        $this->assertFalse(Json::isJsonAsObject(\json_encode(false)));
        $this->assertFalse(Json::isJsonAsObject(\json_encode(true)));
        $this->assertFalse(Json::isJsonAsObject(\json_encode(null)));
        $this->assertFalse(Json::isJsonAsObject(\json_encode('string')));
        $this->assertFalse(Json::isJsonAsObject(\json_encode('')));
        $this->assertFalse(Json::isJsonAsObject(\json_encode([])));
        $this->assertFalse(Json::isJsonAsObject('123'));
        $this->assertFalse(Json::isJsonAsObject('1.1'));
        $this->assertFalse(Json::isJsonAsObject('false'));
        $this->assertFalse(Json::isJsonAsObject('true'));
        $this->assertFalse(Json::isJsonAsObject('null'));
        $this->assertFalse(Json::isJsonAsObject(null));
        $this->assertFalse(Json::isJsonAsObject('[]'));
        $this->assertFalse(Json::isJsonAsObject('[{"key1":"value"},{"key1":"value"},{"key1":"value"}]'));
        $this->assertFalse(Json::isJsonAsObject(''));
        $this->assertFalse(Json::isJsonAsObject('""'));
        $this->assertFalse(Json::isJsonAsObject('"string"'));
        $this->assertFalse(Json::isJsonAsObject(' '));
        $this->assertFalse(Json::isJsonAsObject('{'));
        $this->assertFalse(Json::isJsonAsObject('}'));
        $this->assertFalse(Json::isJsonAsObject('['));
        $this->assertFalse(Json::isJsonAsObject(']'));
    }
}
