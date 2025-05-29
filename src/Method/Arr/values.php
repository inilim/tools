<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * Return all the values of an array
 * @link https://php.net/manual/en/function.array-values.php
 * @template TValue
 * @param array<int|string,TValue> $array
 * The array.
 * @return TValue[] an indexed array of values.
 */
function values(array $array): array
{
    return \array_values($array);
}
