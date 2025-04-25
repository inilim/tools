<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @todo check PR _set()
 * @author laravel
 * Set an array item to a given value using "dot" notation.
 * If no key is given to the method, the entire array will be replaced.
 * @return \Closure(array &$array, ?string $key, mixed $value):array
 */
function set()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException(__FUNCTION__ . '()(...) <-- The arguments were passed to the wrong place');
    }

    return static function (array &$array, ?string $key, $value) {
        if ($key === null) {
            return $array = $value;
        }

        $keys = \explode('.', $key);

        foreach ($keys as $i => $key) {
            if (\sizeof($keys) === 1) {
                break;
            }

            unset($keys[$i]);

            // If the key doesn't exist at this depth, we will just create an empty array
            // to hold the next value, allowing us to create the arrays to hold final
            // values at the correct depth. Then we'll keep digging into the array.
            if (!isset($array[$key]) || !\is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[\array_shift($keys)] = $value;

        return $array;
    };
}





/**
 * Set an array item to a given value using "dot" notation.
 * If no key is given to the method, the entire array will be replaced.
 * @return \Closure(array &$array, ?string $key, mixed $value):array
 */
function _set()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException(__FUNCTION__ . '()(...) <-- The arguments were passed to the wrong place');
    }

    return static function (array &$array, ?string $key, $value) {
        if ($key === null) {
            return $array = $value;
        }

        if ($key === '') {
            $array[''] = $value;

            return $array;
        }

        $current = &$array;
        $segment = \strtok($key, '.');

        while (true) {
            $nextSegment = \strtok('.');

            if ($nextSegment === false) {
                $current[$segment] = $value;
                break;
            } else {
                if (! isset($current[$segment]) || ! \is_array($current[$segment])) {
                    $current[$segment] = [];
                }
                $current = &$current[$segment];
                $segment = $nextSegment;
            }
        }
        unset($current);

        return $array;
    };
}
