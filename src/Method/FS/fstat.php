<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @author inilim
 * @see https://www.php.net/manual/ru/function.fstat.php
 * @param resource $stream
 */
function fstat($stream): ?array
{
    \Inilim\Tool\Method\Assert\resource($stream);
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn() => \fstat($stream), null);
    return \is_bool($value) ? null : $value;
}
