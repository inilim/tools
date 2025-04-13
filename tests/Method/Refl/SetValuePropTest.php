<?php

namespace Inilim\Tool\Test\Method\Refl;

use Inilim\Tool\Refl;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\Group;
use Inilim\Tool\Test\ForTest\ClassicClass;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @group inactive
 */
class SetValuePropTest extends TestCase
{
    /**
     * @dataProvider data
     */
    function test_public_prop_type_array($value)
    {
        $obj = new ClassicClass;

        // ---------------------------------------------
        // assert
        // ---------------------------------------------

        $res = Refl::setValueProp($obj, 'publicPropArray', $value);
        if (!\is_array($value)) {
            $this->assertFalse($res, \gettype($value));
        } else {
            $this->assertTrue($res, \gettype($value));
        }
    }

    /**
     * @dataProvider data
     */
    function test_public_prop_type_bool($value)
    {
        $obj = new ClassicClass;

        // ---------------------------------------------
        // assert
        // ---------------------------------------------

        $res = Refl::setValueProp($obj, 'publicPropBool', $value);
        if (!\is_bool($value)) {
            $this->assertFalse($res, \gettype($value));
        } else {
            $this->assertTrue($res, \gettype($value));
        }
    }

    static function data()
    {
        $values = [
            [''],
            ['string'],
            [true],
            [false],
            [new \stdClass],
            [0.111],
            [-0.111],
            [123],
            [-123],
        ];

        $values[] = [$values];
        $values[] = [[]];

        return $values;
    }
}
