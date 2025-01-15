<?php

namespace Inilim\Tool\Method\Arr;

function resetKeysRecursive(array $array): array
{
    $array = \array_values($array);
    foreach ($array as $idx => $value) {
        $array[$idx] = \is_array($value) ? \Inilim\Tool\Method\Arr\resetKeysRecursive($value) : $value;
    }
    return $array;
}
