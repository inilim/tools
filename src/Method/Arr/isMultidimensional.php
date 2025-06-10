<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * проверка на многомерный массив
 * true - многомерный
 * false - одномерный
 */
function isMultidimensional(array $array): bool
{
    foreach ($array as $item) {
        if (\is_array($item)) {
            return true;
        }
    }
    return false;
    // return \sizeof(\array_filter($array, 'is_array')) > 0;
}
