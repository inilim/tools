<?php

declare(strict_types=1);

use Inilim\Tool\Other;
use Inilim\Tool\Test\ForTest\ClassicClass;

class getCallableThisTest extends \Inilim\Tool\Test\TestCase
{
    // Тест для случая с Closure без привязанного объекта
    function testWithClosureWithoutThis()
    {
        $closure = static function () {};
        $result = Other::getCallableThis($closure);
        $this->assertNull($result);
    }

    // Тест для случая с Closure с привязанным объектом
    function testWithClosureWithThis()
    {
        $obj = new stdClass();
        $closure = function () {};
        $closure = $closure->bindTo($obj);
        $result = Other::getCallableThis($closure);
        $this->assertSame($obj, $result);
    }

    // Тест для случая с callable-объектом (реализующим __invoke)
    function testWithInvokableObject()
    {
        $obj = new class {
            function __invoke() {}
        };
        $result = Other::getCallableThis($obj);
        $this->assertSame($obj, $result);
    }

    // Тест для случая с массивом, где первый элемент - объект
    function testWithObjectMethodArray()
    {
        $obj = new ClassicClass();
        $callable = [$obj, 'publicMethod'];
        $result = Other::getCallableThis($callable);
        $this->assertSame($obj, $result);
    }

    // Тест для случая с массивом, где первый элемент - не объект
    function testWithNonObjectMethodArray()
    {
        $callable = [ClassicClass::class, 'publicStaticMethod'];
        $result = Other::getCallableThis($callable);
        $this->assertNull($result);
    }

    // Тест для случая с строкой (название функции)
    function testWithFunctionNameString()
    {
        $callable = 'strlen';
        $result = Other::getCallableThis($callable);
        $this->assertNull($result);
    }

    // Тест для случая с инвалидным callable (просто для полноты)
    function testWithInvalidCallable()
    {
        $this->expectException(\TypeError::class);
        Other::getCallableThis('nonexistent_function');
    }
}
