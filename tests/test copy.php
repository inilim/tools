<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Inilim\Dump\Dump;

Dump::init();



dUsage();


static function (array $array, $key) {
    $value = \array_search(
        \key([$key => null]),
        \array_keys($array),
        true
    );
    return $value === false ? null : $value;
};

dUsage();






de();
final class Test
{
    protected static $instance;

    protected function __construct() {}

    static function __callStatic($name, $arguments)
    {
        self::$instance ??= new self;
        return self::$instance->__get($name);
    }

    function __get($name)
    {
        return static function () {
            echo 123;
        };
    }
}

Test::name()();
