<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * check is valid regex
 * @author inilim
 * @psalm-pure
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * @param mixed  $value
 */
function patternRegex($value): bool
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
