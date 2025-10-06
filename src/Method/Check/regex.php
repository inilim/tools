<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author inilim
 * @psalm-pure
 * @param mixed  $value
 */
function regex($value): bool
{
    if (!\is_string($value)) {
        return false;
    }
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => \preg_match($value, ''),
        null
    );
    return \is_int($result) ? true : false;
}
