<?php

namespace Inilim\Tool\Test;

use Inilim\Dump\Dump;

class TestCase extends \PHPUnit\Framework\TestCase
{
    static function setUpBeforeClass(): void
    {
        Dump::init();
    }
}
