<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('resetKeysRecursive');

function resetKeysRecursive(array $array): array
{
    $array = \array_values($array);
    foreach ($array as $idx => $value) {
        $array[$idx] = \is_array($value) ? Arr::resetKeysRecursive($value) : $value;
    }
    return $array;
}
