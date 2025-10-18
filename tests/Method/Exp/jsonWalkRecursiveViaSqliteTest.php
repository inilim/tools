<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\Exp;
use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;

/**
 * TODO нужно еще тесты
 */
class jsonWalkRecursiveViaSqliteTest extends TestCase
{
    function testExp1()
    {
        $array_json = \json_encode([]);
        $this->expectException(\InvalidArgumentException::class);
        Exp::jsonWalkRecursiveViaSqlite(
            $array_json,
            function ($key, $value, $type, $fullkey) {},
            -1
        );
    }
    function testExp2()
    {
        $array_json = \json_encode([]);
        $this->expectException(\InvalidArgumentException::class);
        Exp::jsonWalkRecursiveViaSqlite(
            $array_json,
            function ($key, $value, $type, $fullkey) {},
            null,
            false,
            ['undefined']
        );
    }
    function testError()
    {
        Other::errorClearLast();
        Exp::jsonWalkRecursiveViaSqlite(
            '{broken json]',
            function ($key, $value, $type, $fullkey) {},
        );
        $error = Other::errorGetLast();
        $this->assertTrue(\is_array($error));
    }

    function test()
    {
        $array_json = \json_encode(\range(1, 100));

        // ---------------------------------------------
        // Проверка количества итераций
        // Проверка типа значений
        // Проверка типа ключа
        // Проверка полного ключа
        // Проверка типа
        // ---------------------------------------------

        $iteration = 0;
        Exp::jsonWalkRecursiveViaSqlite($array_json, function ($key, $value, $type, $fullkey) use (&$iteration) {
            $iteration++;
            $this->assertTrue(\is_int($key));
            $this->assertTrue(\is_int($value));
            $this->assertTrue(\is_string($fullkey));
            $this->assertFalse(\str_starts_with($fullkey, '$.'));
            $this->assertSame('int', $type);
        });

        $this->assertSame(100, $iteration);

        // ---------------------------------------------
        // Проверка лимитов
        // ---------------------------------------------

        $iteration = 0;
        Exp::jsonWalkRecursiveViaSqlite($array_json, function ($key, $value, $type, $fullkey) use (&$iteration) {
            $iteration++;
        }, 1);
        $this->assertSame(1, $iteration);

        // ---------------------------------------------
        // Проверка лимитов
        // ---------------------------------------------

        $iteration = 0;
        Exp::jsonWalkRecursiveViaSqlite($array_json, function ($key, $value, $type, $fullkey) use (&$iteration) {
            $iteration++;
        }, 7);
        $this->assertSame(7, $iteration);

        // ---------------------------------------------
        // Проверка значения для сброса $valueBreak по дефолту false
        // ---------------------------------------------

        $iteration = 0;
        Exp::jsonWalkRecursiveViaSqlite($array_json, function ($key, $value, $type, $fullkey) use (&$iteration) {
            $iteration++;
            return false;
        });
        $this->assertSame(1, $iteration);

        // ---------------------------------------------
        // Проверка значения для сброса $valueBreak произвольный
        // ---------------------------------------------

        $iteration = 0;
        Exp::jsonWalkRecursiveViaSqlite($array_json, function ($key, $value, $type, $fullkey) use (&$iteration) {
            $iteration++;
            return 'break';
        }, null, 'break');
        $this->assertSame(1, $iteration);

        // ---------------------------------------------
        // Проверка значения для сброса $valueBreak произвольный, но не верный
        // ---------------------------------------------

        $iteration = 0;
        Exp::jsonWalkRecursiveViaSqlite($array_json, function ($key, $value, $type, $fullkey) use (&$iteration) {
            $iteration++;
            return false;
        }, null, 'break');
        $this->assertSame(100, $iteration);

        // ---------------------------------------------
        // Проверка фильтрации по типу
        // ---------------------------------------------

        $iteration = 0;
        Exp::jsonWalkRecursiveViaSqlite($array_json, function ($key, $value, $type, $fullkey) use (&$iteration) {
            $iteration++;
        }, null, false, ['int']);
        $this->assertSame(100, $iteration);

        // ---------------------------------------------
        // Проверка фильтрации по типу
        // ---------------------------------------------

        $iteration = 0;
        Exp::jsonWalkRecursiveViaSqlite($array_json, function ($key, $value, $type, $fullkey) use (&$iteration) {
            $iteration++;
        }, null, false, ['string']);
        $this->assertSame(0, $iteration);
    }

    function test2()
    {
        $array_json = \json_encode([
            'key_string' => 'string',
            'key_int' => 100,
            'key_float' => 1.1,
            'key_null' => null,
            'key_bool_true' => true,
            'key_bool_false' => false,
            'key_array' => [1, 2, 3],
            'key_object' => ['key' => 'value'],
        ]);

        // ---------------------------------------------
        // Проверка ассоциативного массива
        // ---------------------------------------------

        $iteration = 0;
        Exp::jsonWalkRecursiveViaSqlite($array_json, function ($key, $value, $type, $fullkey) use (&$iteration) {
            $this->assertTrue(\is_string($fullkey));
            $this->assertFalse(\str_starts_with($fullkey, '$.'));

            if ($key === 'key_string') {
                $this->assertSame('string', $type);
                $this->assertTrue(\is_string($value));
                $iteration++;
            } elseif ($key === 'key_int') {
                $this->assertSame('int', $type);
                $this->assertTrue(\is_int($value));
                $iteration++;
            } elseif ($key === 'key_bool_true') {
                $this->assertSame('bool', $type);
                $this->assertTrue(\is_bool($value));
                $iteration++;
            } elseif ($key === 'key_bool_false') {
                $this->assertSame('bool', $type);
                $this->assertTrue(\is_bool($value));
                $iteration++;
            } elseif ($key === 'key_float') {
                $this->assertSame('float', $type);
                $this->assertTrue(\is_float($value));
                $iteration++;
            } elseif ($key === 'key_null') {
                $this->assertSame('null', $type);
                $this->assertTrue(\is_null($value));
                $iteration++;
            } elseif ($key === 'key_array') {
                $this->assertSame('array', $type);
                $this->assertTrue(\is_string($value));
                $this->assertJson($value);
                $this->assertTrue(\is_array(\json_decode($value)));
                $iteration++;
            } elseif ($key === 'key_object') {
                $this->assertSame('object', $type);
                $this->assertTrue(\is_string($value));
                $this->assertJson($value);
                $this->assertTrue(\is_object(\json_decode($value)));
                $iteration++;
            }
        });
        $this->assertSame(8, $iteration);

        // ---------------------------------------------
        // 
        // ---------------------------------------------
    }
}
