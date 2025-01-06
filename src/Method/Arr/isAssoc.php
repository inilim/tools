<?php

namespace Inilim\Method\Arr;

/**
 * Determines if an array is associative.
 * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
 */
function isAssoc(array $array): bool
{
    $keys = \array_keys($array);
    return \array_keys($keys) !== $keys;
}
