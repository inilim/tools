<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @return bool
 */
function compareValues(array $a, array $b, array ...$arrays)
{
    $arrays[] = $a;
    $arrays[] = $b;
    $arrays = \array_map(
        static fn($array) => \md5(\serialize($array)),
        \Inilim\Tool\Method\Arr\sortRecursive(\Inilim\Tool\Method\Arr\resetKeysRecursive($arrays))
    );
    return \sizeof(\Inilim\Tool\Method\Arr\unique($arrays)) === 1;
}
