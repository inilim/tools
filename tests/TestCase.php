<?php

namespace Inilim\Tool\Test;

class TestCase extends \PHPUnit\Framework\TestCase
{
    static function setUpBeforeClass(): void
    {
        require_once __DIR__ . '/../bootstrap.dev.php';
    }
}
