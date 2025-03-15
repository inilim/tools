<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @return bool
 */
function renameDotKey(array &$array, string $oldKey, string $newKey)
{
    $tArr   = \Inilim\Tool\Method\Arr\dot($array);
    $result = \Inilim\Tool\Method\Arr\renameKey($tArr, $oldKey, $newKey);
    $array  = \Inilim\Tool\Method\Arr\undot($tArr);
    return $result;
}
