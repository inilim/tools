<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * @return \Closure(array &$array, array $keys, mixed $value, bool $overwrite):void
 */
function fillKeysByRef(): \Closure
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException('fillKeysByRef()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (array &$array, array $keys, $value, bool $overwrite = true) {
        foreach ($keys as $key) {
            if ($overwrite || !\array_key_exists($key, $array)) {
                $array[$key] = $value;
            }
        }
    };
}
