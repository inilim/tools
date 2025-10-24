<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Seeks on a file pointer
 * @link https://php.net/manual/en/function.fseek.php
 * @param resource $stream
 */
function phpfseek($stream, int $offset, int $whence = \SEEK_SET): int
{
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn() => \fseek($stream, $offset, $whence));
    return $result === null ? -1 : $result;
}
