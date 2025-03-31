<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * Prepend the key names of an associative array.
 */
function prependKeysWith(array $array, string $prepend_with): array
{
    return \Inilim\Tool\Method\Arr\mapWithKeys(
        $array,
        static fn($item, $key) => [$prepend_with . $key => $item]
    );
}
