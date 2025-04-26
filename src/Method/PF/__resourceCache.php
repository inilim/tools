<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @return mixed
 */
function __resourceCache(string $name)
{
    static $o = null;
    $o ??= [];

    if (\array_key_exists($name, $o)) {
        return $o[$name];
    }

    return $o[$name] = \Inilim\Tool\Method\PF\__resource($name);
}
