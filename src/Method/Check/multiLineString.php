<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author Inilim
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * @param mixed $value
 */
function multiLineString($value): bool
{
    return \is_string($value) && \preg_match(
        // @see Inilim\Tool\Method\Str\unixNewLines
        "/\r\n|\n|\r|" . \base64_decode('4oCo', true) . "|" . \base64_decode('4oCp', true) . "/",
        $value
    ) === 1;
}
