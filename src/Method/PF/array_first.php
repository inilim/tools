<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @template T of mixed
 * @param T[] $array
 * @return ?T
 */
function array_first(array $array)
{
    if (\Inilim\Tool\Method\Check\php85()) {
        return \array_first($array);
    }
    foreach ($array as $value) {
        return $value;
    }
    return null;
}
