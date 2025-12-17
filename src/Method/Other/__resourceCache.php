<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @return mixed
 */
function __resourceCache(string $namespace, string $name)
{
    static $o = null;
    $o ??= [];
    // __FUNCTION__ => Inilim\Tool\Method\Other\__resource => Other
    $class = \basename(\dirname(\strtr($namespace, '\\', '/')));
    $o[$class] ??= [];
    if (\array_key_exists($name, $o[$class])) {
        return $o[$class][$name];
    }

    return $o[$class][$name] = \Inilim\Tool\Method\Other\__resource($namespace, $name);
}
