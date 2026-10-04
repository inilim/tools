<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Remove one or many array items from a given array using "dot" notation.
 *
 * @return \Closure(array $array, array|string|int|float $keys):void
 */
function forget(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (&$array, $keys) {

        $original = &$array;

        $keys = (array) $keys;

        if ($keys === []) {
            return;
        }

        foreach ($keys as $key) {
            // clean up before each pass
            $array = &$original;

            // if the exact key exists in the top-level, remove it
            if (\Inilim\Tool\Method\LarArr\exists($array, $key)) {
                unset($array[$key]);

                continue;
            }

            $parts = \explode('.', $key);

            while (\count($parts) > 1) {
                $part = \array_shift($parts);

                if (isset($array[$part]) && \Inilim\Tool\Method\LarArr\accessible($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }

            unset($array[\array_shift($parts)]);
        }
    };
}
