<?php

namespace Inilim\Method\Arr;

\Inilim\Tool\Arr::__include([
    'sortRecursive',
    'resetKeysRecursive',
    'unique',
]);

function compareValues(array $a, array $b, array ...$arrays): bool
{
    $arrays[] = $a;
    $arrays[] = $b;
    $arrays = \array_map(
        static fn($array) => \md5(\serialize($array)),
        \Inilim\Method\Arr\sortRecursive(\Inilim\Method\Arr\resetKeysRecursive($arrays))
    );
    return \sizeof(\Inilim\Method\Arr\unique($arrays)) === 1;
}
