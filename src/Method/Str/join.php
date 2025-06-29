<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @param iterable<array-key,string> $iterable
 */
function join(iterable $iterable, string $separator = ''): string
{
    if ($iterable instanceof \Traversable) {
        $iterable = \iterator_to_array($iterable);
    }
    return \implode($separator, $iterable);
}
