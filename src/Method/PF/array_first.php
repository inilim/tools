<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @template T
 * @param array<T> $array
 * @return (
 *      $array is array{} ? null :
 *      $array is non-empty-array ? T :
 *      ?T
 * )
 */
function array_first(array $array)
{
    if (\Inilim\Tool\Method\Check\php85()) {
        return \array_first($array);
    }

    foreach ($array as $value) {
        return $value;
    }
    return null;
}
