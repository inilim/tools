<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * [EN] the function checks whether the library is in the cloning state.
 * [RU] функция проверяет, находится ли библиотека в состоянии клонирования.
 * @author inilim
 * @todo tests
 */
function itLibClone(): bool
{
    $dir = \Inilim\Tool\Method\Path\normalize(__DIR__);
    if (!\Inilim\Tool\Method\PF\str_contains($dir, '/src/')) {
        \Inilim\Tool\Method\Other\__setErrorLast(-1, 'The library\'s file structure is broken', '', -1);
        return false;
    }

    if (!\Inilim\Tool\Method\PF\str_contains($dir, '/vendor/')) {
        return false;
    }

    $dir = \Inilim\Tool\Method\Str\beforeLast($dir, '/src/');
    return \Inilim\Tool\Method\FS\isDir($dir . '/.git');
}
