<?php

namespace Inilim\Method\Arr;

/**
 * Take the first or last {$limit} items from an array.
 * @template TArray
 * @param TArray $array
 * @return TArray
 */
function take(array $array, int $limit): array
{
    if ($limit < 0) {
        return \array_slice($array, $limit, \abs($limit));
    }

    return \array_slice($array, 0, $limit);
}
