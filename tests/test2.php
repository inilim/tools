<?php

declare(strict_types=1);

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

function __resource(string $name)
{
    if (\is_file($name = __DIR__ . '/' . $name . '.php')) {
        return require $name;
    }

    return null;
}

dUsage();

$a = \__resource('testResourceClosureGenerator');

dUsage();

unset($a);

dUsage();
