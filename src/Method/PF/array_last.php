<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @template T of mixed
 * @param T[] $array
 * @return ?T
 */
function array_last(array $array)
{
    if (\Inilim\Tool\Method\Check\php85()) {
        return \array_last($array);
    }

    return $array ? \current(\array_slice($array, -1)) : null;
}
