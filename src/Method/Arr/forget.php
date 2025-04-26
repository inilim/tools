<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Remove one or many array items from a given array using "dot" notation.
 * @return \Closure(array &$array, (string|int)[]|string|int $keys):void
 */
function forget()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException('forget()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (array &$array, $keys) {
        $original = &$array;

        $keys = (array) $keys;

        if (!$keys) return;

        foreach ($keys as $key) {
            // if the exact key exists in the top-level, remove it
            if (\Inilim\Tool\Method\Arr\exists($array, $key)) {
                unset($array[$key]);

                continue;
            }

            $parts = \explode('.', $key);

            // clean up before each pass
            $array = &$original;

            while (\sizeof($parts) > 1) {
                $part = \array_shift($parts);

                if (isset($array[$part]) && \is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }

            unset($array[\array_shift($parts)]);
        }
    };
}
