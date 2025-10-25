<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @link https://php.net/manual/en/function.glob.php
 * @param \GLOB_* $flags
 * @return string[]|null
 */
function phpGlob(string $pattern, int $flags = 0): ?array
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn() => \glob($pattern, $flags));
    /** @var array|false $value */
    return $value === false ? null : $value;
}
