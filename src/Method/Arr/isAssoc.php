<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * Determines if an array is associative.
 * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
 * @return bool
 */
function isAssoc(array $array)
{
    $keys = \array_keys($array);
    return \array_keys($keys) !== $keys;
}
