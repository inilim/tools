<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Closes an open file pointer
 * @link https://php.net/manual/en/function.fclose.php
 * @param resource $stream
 */
function phpfclose($stream): bool
{
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn() => \fclose($stream));
    return $result === null ? false : $result;
}
