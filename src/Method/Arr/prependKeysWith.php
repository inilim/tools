<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * Prepend the key names of an associative array.
 */
function prependKeysWith(array $array, string $prependWith): array
{
    return \Inilim\Tool\Method\Arr\mapWithKeys(
        $array,
        static fn($item, $key) => [$prependWith . $key => $item]
    );
}
