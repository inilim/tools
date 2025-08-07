<?php

declare(strict_types=1);

\error_reporting(\E_ALL);
\define('DIR_ROOT', __DIR__);

require_once __DIR__ . '/vendor/autoload.php';

use Inilim\Dump\Dump;

Dump::init();

if (!\function_exists('__include')) {
    /**
     * @param string|string[] $names example "Other::getClassContextFromClosure"
     * @return void
     * TODO add ...$name
     */
    function __include($names)
    {
        if (\is_string($names)) {
            $names = [$names];
        }

        foreach ($names as $name) {
            [$class, $func] = \preg_split('#(::)|(\\\\)#', $name);

            $pathToFile = \sprintf(
                '%s/src/Method/%s/%s.php',
                __DIR__,
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
    }
}

if (!\function_exists('infoStringFunction')) {
    function infoStringFunction(string $name)
    {
        $refl = new \ReflectionFunction($name);

        $result = [
            'str' => $refl->__toString(),
            'args' => [],
        ];

        foreach ($refl->getParameters() as $param) {
            $result['args'][] = [
                'name' => $param->getName(),
                'pos'  => $param->getPosition(),
                // 'default' => $param->getDefaultValue(),
                'str' => $param->__toString(),
                'type' => $param->getType() ? $param->getType()->getName() : 'mixed',
            ];
        }

        return $result;
    }
}
