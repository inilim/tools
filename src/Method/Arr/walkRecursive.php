<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * @psalm-import-type Return_walkRecursive from \TypeArr
 * 
 * @return Return_walkRecursive
 */
function walkRecursive(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (&$array, callable $callable) {
        $depth = 0;
        $recursive = static function (&$array, $callable, $recursive) use (&$depth) {
            /**
             * @param object|mixed[] $array
             */
            foreach ($array as $key => &$value) {
                $callable($value, $key, $depth);
                if (\is_iterable($value)) {
                    $depth++;
                    $recursive($value, $callable, $recursive);
                    $depth--;
                }
            }
        };

        $recursive($array, $callable, $recursive);
    };
}
