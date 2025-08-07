<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author nette/utils
 * Renames key in array.
 * @return \Closure(array &$array, string|int $oldKey, string|int $newKey):bool
 */
function renameKey(): \CLosure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());
    return static function (array &$array, $oldKey, $newKey) {
        $offset = \Inilim\Tool\Method\Arr\getKeyOffset($array, $oldKey);
        if ($offset === null) {
            return false;
        }

        $val = &$array[$oldKey];
        $keys = \array_keys($array);
        $keys[$offset] = $newKey;
        $array = \array_combine($keys, $array);
        $array[$newKey] = &$val;
        return true;
    };
}
