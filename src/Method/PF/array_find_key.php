<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @return null|string|int
 */
function array_find_key(array $array, callable $callback)
{
    if (\Inilim\Tool\Method\Check\php84()) {
        return \array_find_key($array, $callback);
    }

    foreach ($array as $key => $value) {
        if ($callback($value, $key)) {
            return $key;
        }
    }

    return null;
}
