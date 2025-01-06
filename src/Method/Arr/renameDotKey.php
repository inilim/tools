<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include([
    'dot',
    'renameKey',
    'undot',
]);

function renameDotKey(array &$array, string $oldKey, string $newKey): bool
{
    $array  = \Inilim\Tool\Method\Arr\dot($array);
    $result = \Inilim\Tool\Method\Arr\renameKey($array, $oldKey, $newKey);
    $array  = \Inilim\Tool\Method\Arr\undot($array);
    return $result;
}
