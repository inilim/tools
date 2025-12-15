<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author https://github.com/kylekatarnls
 * @todo tests
 * @throws \InvalidArgumentException
 * @throws \ValueError
 */
function throwValueErrorIfAvailable($message = '', $code = 0, \Throwable $previous = null): void
{
    if (!\Inilim\Tool\Method\Other\classPhp(\ValueError::class)) {
        throw new \InvalidArgumentException($message, $code, $previous);
    }
    throw new \ValueError($message, $code, $previous);
}
