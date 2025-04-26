<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @param callable():bool $callback
 * @return mixed
 */
function array_find(array $array, callable $callback)
{
    if (\Inilim\Tool\Method\Check\php84()) {
        return \array_find($array, $callback);
    }

    foreach ($array as $key => $value) {
        if ($callback($value, $key)) {
            return $value;
        }
    }

    return null;
}
