<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @return \Closure(array &$array, string $oldKey, string $newKey):bool
 */
function renameDotKey(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (array &$array, string $oldKey, string $newKey): bool {
        $tArr   = \Inilim\Tool\Method\LarArr\dot($array);
        $result = \Inilim\Tool\Method\Arr\renameKey()($tArr, $oldKey, $newKey);
        $array  = \Inilim\Tool\Method\LarArr\undot($tArr);
        return $result;
    };
}
