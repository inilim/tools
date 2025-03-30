<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @return \Closure(array &$array, string $oldKey, string $newKey):bool
 */
function renameDotKey()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException(__FUNCTION__ . '()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (array &$array, string $oldKey, string $newKey) {
        $tArr   = \Inilim\Tool\Method\Arr\dot($array);
        $result = \Inilim\Tool\Method\Arr\renameKey()($tArr, $oldKey, $newKey);
        $array  = \Inilim\Tool\Method\Arr\undot($tArr);
        return $result;
    };
}
