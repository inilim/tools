<?php

namespace Inilim\Tool\Method\Arr;

\Inilim\Tool\Arr::__include([
    'accessible',
    'exists',
]);

/**
 * Set an item on an array or object using dot notation.
 * @param mixed $target
 * @param string|string[] $key
 * @param mixed $value
 * @return mixed
 */
function dataSet(&$target, $key, $value, bool $overwrite = true)
{
    $segments = \is_array($key) ? $key : \explode('.', $key);

    if (($segment = \array_shift($segments)) === '*') {
        if (!accessible($target)) {
            $target = [];
        }

        if ($segments) {
            foreach ($target as &$inner) {
                dataSet($inner, $segments, $value, $overwrite);
            }
        } elseif ($overwrite) {
            foreach ($target as &$inner) {
                $inner = $value;
            }
        }
    } elseif (accessible($target)) {
        if ($segments) {
            if (!exists($target, $segment)) {
                $target[$segment] = [];
            }

            dataSet($target[$segment], $segments, $value, $overwrite);
        } elseif ($overwrite || !exists($target, $segment)) {
            $target[$segment] = $value;
        }
    } elseif (\is_object($target)) {
        if ($segments) {
            if (!isset($target->{$segment})) {
                $target->{$segment} = [];
            }

            dataSet($target->{$segment}, $segments, $value, $overwrite);
        } elseif ($overwrite || !isset($target->{$segment})) {
            $target->{$segment} = $value;
        }
    } else {
        $target = [];

        if ($segments) {
            dataSet($target[$segment], $segments, $value, $overwrite);
        } elseif ($overwrite) {
            $target[$segment] = $value;
        }
    }

    return $target;
}
