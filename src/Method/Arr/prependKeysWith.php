<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('mapWithKeys');

/**
 * Prepend the key names of an associative array.
 */
function prependKeysWith(array $array, string $prepend_with): array
{
    return \Inilim\Method\Arr\mapWithKeys(
        $array,
        static fn($item, $key) => [$prepend_with . $key => $item]
    );
}
