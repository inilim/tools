<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Returns the current position of the file read/write pointer
 * @link https://php.net/manual/en/function.ftell.php
 * @param resource $stream
 * @return int|false
 */
function phpftell($stream)
{
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn() => \ftell($stream));
    return $result === null ? false : $result;
}
