<?php

namespace Inilim\Tool\Method\Arr;

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
        \Inilim\Tool\Method\Arr\sortRecursive(\Inilim\Tool\Method\Arr\resetKeysRecursive($arrays))
    );
    return \sizeof(\Inilim\Tool\Method\Arr\unique($arrays)) === 1;
}
