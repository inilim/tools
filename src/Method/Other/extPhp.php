<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 */
function extPhp(string $ext, bool $rechecking = false): bool
{
    static $o = null;
    $o ??= [];

    if (isset($o[$ext]) && false === $rechecking) {
        return $o[$ext];
    }

    return $o[$ext] = \extension_loaded($ext);
}
