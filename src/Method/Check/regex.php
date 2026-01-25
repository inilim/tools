<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * check is valid regex
 * @author inilim
 * @psalm-pure
 * @psalm-assert-if-true string $regex
 * @phpstan-assert-if-true string $regex
 * @param mixed  $regex
 */
function regex($regex): bool
{
    if (!\is_string($regex)) {
        return false;
    }
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => \preg_match($regex, ''),
        null
    );
    return \is_int($result) ? true : false;
}
