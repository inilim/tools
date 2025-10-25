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
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn() => \fstat($stream));
    return \is_bool($value) ? null : $value;
}
