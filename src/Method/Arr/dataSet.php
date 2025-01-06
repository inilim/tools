<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include([
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
        if (!\Inilim\Method\Arr\accessible($target)) {
            $target = [];
        }

        if ($segments) {
            foreach ($target as &$inner) {
                \Inilim\Method\Arr\dataSet($inner, $segments, $value, $overwrite);
            }
        } elseif ($overwrite) {
            foreach ($target as &$inner) {
                $inner = $value;
            }
        }
    } elseif (\Inilim\Method\Arr\accessible($target)) {
        if ($segments) {
            if (!\Inilim\Method\Arr\exists($target, $segment)) {
                $target[$segment] = [];
            }

            \Inilim\Method\Arr\dataSet($target[$segment], $segments, $value, $overwrite);
        } elseif ($overwrite || !\Inilim\Method\Arr\exists($target, $segment)) {
            $target[$segment] = $value;
        }
    } elseif (\is_object($target)) {
        if ($segments) {
            if (!isset($target->{$segment})) {
                $target->{$segment} = [];
            }

            \Inilim\Method\Arr\dataSet($target->{$segment}, $segments, $value, $overwrite);
        } elseif ($overwrite || !isset($target->{$segment})) {
            $target->{$segment} = $value;
        }
    } else {
        $target = [];

        if ($segments) {
            \Inilim\Method\Arr\dataSet($target[$segment], $segments, $value, $overwrite);
        } elseif ($overwrite) {
            $target[$segment] = $value;
        }
    }

    return $target;
}
