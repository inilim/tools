<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Binary-safe file read
 * @link https://php.net/manual/en/function.fread.php
 * @param resource $stream
 * @return string|false
 */
function phpfread($stream, int $length)
{
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn() => \fread($stream, $length));
    return $result === null ? false : $result;
}
