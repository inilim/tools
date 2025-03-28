<?php

namespace Inilim\Tool\Test;

use Inilim\Dump\Dump;

class TestCase extends \PHPUnit\Framework\TestCase
{
    static public $values;

    static function setUpBeforeClass(): void
    {
        $values = [
            '',
            'string',
            true,
            false,
            new \stdClass,
            0.111,
            -0.111,
            123,
            -123,
        ];

        $values[] = $values;
        $values[] = [];

        self::$values = $values;

        Dump::init();
    }
}
