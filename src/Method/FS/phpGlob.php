<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @return string[]|null
 */
function phpGlob(string $pattern, int $flags = 0): ?array
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn() => \glob($pattern, $flags), null);
    /** @var array|false $value */
    return $value === false ? null : $value;
}
