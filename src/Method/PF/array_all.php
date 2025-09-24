<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 */
function array_all(array $array, callable $callback): bool
{
    if (\Inilim\Tool\Method\Check\php84()) {
        return \array_all($array, $callback);
    }

    foreach ($array as $key => $value) {
        if (!$callback($value, $key)) {
            return false;
        }
    }

    return true;
}
