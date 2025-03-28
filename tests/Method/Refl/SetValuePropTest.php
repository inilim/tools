<?php

namespace Inilim\Tool\Test\Method\Refl;

use Inilim\Tool\Refl;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassicClass;

class SetValuePropTest extends TestCase
{
    function test_public_prop_type_array()
    {
        // 
        $obj = new ClassicClass;

        // ---------------------------------------------
        // assert
        // ---------------------------------------------

        // Убираем массив
        $values = \array_filter(self::$values, static function ($v) {
            return !\is_array($v);
        });

        foreach ($values as $value) {
            $res = Refl::setValueProp($obj, 'publicPropArray', $value);
            $this->assertFalse($res, \gettype($value));
        }

        // ---------------------------------------------
        // assert
        // ---------------------------------------------

        // берем только массив
        $values = \array_filter(self::$values, static function ($v) {
            return \is_array($v);
        });

        foreach ($values as $value) {
            $res = Refl::setValueProp($obj, 'publicPropArray', $value);
            $this->assertTrue($res, \gettype($value));
        }
    }

    function test_public_prop_type_bool()
    {
        // 
        $obj = new ClassicClass;

        // ---------------------------------------------
        // assert
        // ---------------------------------------------

        // Убираем массив
        $values = \array_filter(self::$values, static function ($v) {
            return !\is_bool($v);
        });

        d($values);

        foreach ($values as $value) {
            $res = Refl::setValueProp($obj, 'publicPropBool', $value);
            dd([
                '$res' => $res,
                '$value' => $value,
            ]);
            $this->assertFalse($res, \gettype($value));
        }

        // ---------------------------------------------
        // assert
        // ---------------------------------------------

        // берем только массив
        $values = \array_filter(self::$values, static function ($v) {
            return \is_bool($v);
        });

        foreach ($values as $value) {
            $res = Refl::setValueProp($obj, 'publicPropBool', $value);
            $this->assertTrue($res, \gettype($value));
        }
    }
}
