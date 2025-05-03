<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 */
function funcPhp(string $function, bool $rechecking = false): bool
{
    static $o = null;
    $o ??= [];

    $function = \ltrim($function, '\\');

    if (isset($o[$function]) && !$rechecking) {
        return $o[$function];
    }

    return $o[$function] = \function_exists($function);
}
