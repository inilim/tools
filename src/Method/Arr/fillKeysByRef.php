<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * @return \Closure(array &$array, array $keys, mixed $value, bool $overwrite):void
 */
function fillKeysByRef(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());
    return static function (array &$array, array $keys, $value, bool $overwrite = true) {
        foreach ($keys as $key) {
            if ($overwrite || !\array_key_exists($key, $array)) {
                $array[$key] = $value;
            }
        }
    };
}
