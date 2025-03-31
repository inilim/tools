<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * получаем ключи dot notation по паттерну | 
 * key.*.key....
 * @return string[]
 */
function dotKeys(iterable $array, string $prepend = '')
{
    $results = [];

    foreach ($array as $key => $value) {
        if (\is_array($value) && !empty($value)) {
            $results = \array_merge($results, \Inilim\Tool\Method\Arr\dotKeys($value, $prepend . $key . '.'));
        } else {
            $results[] = $prepend . $key;
        }
    }

    return $results;
}
