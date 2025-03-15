<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Set an item on an array or object using dot notation.
 * @template T of array|object
 * @param T $target
 * @param string|string[] $key
 * @param mixed $value
 * @return T
 */
function dataSet(&$target, $key, $value, bool $overwrite = true)
{
    $segments = \is_array($key) ? $key : \explode('.', $key);

    if (($segment = \array_shift($segments)) === '*') {
        if (!\Inilim\Tool\Method\Arr\accessible($target)) {
            $target = [];
        }

        if ($segments) {
            foreach ($target as &$inner) {
                \Inilim\Tool\Method\Arr\dataSet($inner, $segments, $value, $overwrite);
            }
        } elseif ($overwrite) {
            foreach ($target as &$inner) {
                $inner = $value;
            }
        }
    } elseif (\Inilim\Tool\Method\Arr\accessible($target)) {
        if ($segments) {
            if (!\Inilim\Tool\Method\Arr\exists($target, $segment)) {
                $target[$segment] = [];
            }

            \Inilim\Tool\Method\Arr\dataSet($target[$segment], $segments, $value, $overwrite);
        } elseif ($overwrite || !\Inilim\Tool\Method\Arr\exists($target, $segment)) {
            $target[$segment] = $value;
        }
    } elseif (\is_object($target)) {
        if ($segments) {
            if (!isset($target->{$segment})) {
                $target->{$segment} = [];
            }

            \Inilim\Tool\Method\Arr\dataSet($target->{$segment}, $segments, $value, $overwrite);
        } elseif ($overwrite || !isset($target->{$segment})) {
            $target->{$segment} = $value;
        }
    } else {
        $target = [];

        if ($segments) {
            \Inilim\Tool\Method\Arr\dataSet($target[$segment], $segments, $value, $overwrite);
        } elseif ($overwrite) {
            $target[$segment] = $value;
        }
    }

    return $target;
}
