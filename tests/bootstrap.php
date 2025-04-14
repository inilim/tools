<?php

declare(strict_types=1);

\error_reporting(\E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Inilim\Dump\Dump;

Dump::init();

/**
 * @param string $name example "Other::getClassContextFromClosure"
 * @return void
 */
function __include(string $name)
{
    [$class, $func] = \explode('::', $name);

    $pathToFile = \sprintf(
        '%s/src/Method/%s/%s.php',
        \dirname(__DIR__),
        $class,
        $func,
    );

    if (!\is_file($pathToFile)) {

        $body = \sprintf(
            '
        %s
        Arg: "%s"
        Файл не найден: "%s"
        %s
        ',
            \str_repeat('-', 30),
            $name,
            $pathToFile,
            \str_repeat('-', 30),
        );
        $body = \explode(PHP_EOL, $body);
        $body = \array_map('trim', $body);
        $body = \implode(PHP_EOL, $body);

        throw new \Exception($body);
    }

    require_once $pathToFile;
}
