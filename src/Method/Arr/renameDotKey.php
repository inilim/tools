<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include([
    'dot',
    'renameKey',
    'undot',
]);

function renameDotKey(array &$array, string $oldKey, string $newKey): bool
{
    $array  = \Inilim\Method\Arr\dot($array);
    $result = \Inilim\Method\Arr\renameKey($array, $oldKey, $newKey);
    $array  = \Inilim\Method\Arr\undot($array);
    return $result;
}
