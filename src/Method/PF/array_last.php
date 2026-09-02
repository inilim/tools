<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @template T
 * @param array<T> $array
 * @return (
 *      $array is array{} ? null :
 *      ($array is non-empty-array ? T :
 *      ?T)
 * )
 */
function array_last(array $array)
{
    if (\Inilim\Tool\Method\Check\php85()) {
        return \array_last($array);
    }

    return $array ? \current(\array_slice($array, -1)) : null;
}
