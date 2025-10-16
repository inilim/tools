<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * the function checks whether the library is in the cloning state.
 * @author inilim
 * @todo tests
 */
function itLibClone(): bool
{
    $dir = __DIR__;
    if (!\Inilim\Tool\Method\PF\str_contains($dir, '/src/')) {
        \Inilim\Tool\Method\Other\__setErrorLast(-1, 'The library\'s file structure is broken', '', -1);
        return false;
    }

    $dir = \Inilim\Tool\Method\Str\beforeLast($dir, '/src/');
    // Наличие папки tests говорит что нас склонировали или скачали
    $dir = \Inilim\Tool\Method\Path\normalize($dir . '/tests');
    return \Inilim\Tool\Method\FS\isDir($dir);
}
