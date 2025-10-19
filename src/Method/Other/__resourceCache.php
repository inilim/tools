<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @return mixed
 */
function __resourceCache(string $class, string $name)
{
    static $o = null;
    $o ??= [];
    $_class = \basename(\dirname(\strtr($class, '\\', '/')));
    $o[$_class] ??= [];
    if (\array_key_exists($name, $o[$_class])) {
        return $o[$_class][$name];
    }

    return $o[$_class][$name] = \Inilim\Tool\Method\Other\__resource($class, $name);
}
