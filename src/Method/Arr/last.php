<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * Get the last element from an array.
 * @template TValue of mixed
 * @param array<TValue> $array
 * @return TValue|false
 */
function last(array $array)
{
    return \end($array);
}
