<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @param array $array
 * @return array
 */
function keysLowerNestedArray(array $array, int $depth = 1): array
{
    return \Inilim\Tool\Method\Arr\nestedMap(
        $array,
        $depth,
        // @deps(\Inilim\Tool\Method\Arr\keysLower)
        '\Inilim\Tool\Method\Arr\keysLower'
    );
}
