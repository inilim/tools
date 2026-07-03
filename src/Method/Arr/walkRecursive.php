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

    return static function (iterable &$array, callable $callable) {
        $depth = 0;
        $fn = static function (iterable &$array, callable $callable, \Closure $fn) use (&$depth) {
            foreach ($array as $key => &$value) {
                $callable($value, $key, $depth);
                if (\is_iterable($value)) {
                    $depth++;
                    $fn($value, $callable, $fn);
                    $depth--;
                }
            }
        };

        $fn($array, $callable, $fn);
    };
}
