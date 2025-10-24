<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Opens file or URL
 * @link https://php.net/manual/en/function.fopen.php
 * @param resource $stream
 * @param ?resource $context
 * @return resource|false
 */
function phpfopen(string $filename, string $mode, bool $use_include_path = false, $context = null)
{
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(
        static fn() => \fopen($filename, $mode, $use_include_path, $context)
    );
    return $result === null ? false : $result;
}
