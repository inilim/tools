<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @param class-string $class
 */
function classPhp(string $class, bool $rechecking = false, bool $autoload = true): bool
{
    static $o = null;
    $o ??= [];

    if (isset($o[$class]) && !$rechecking) {
        return $o[$class];
    }

    return $o[$class] = \class_exists($class, $autoload);
}
