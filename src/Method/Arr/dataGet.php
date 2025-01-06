<?php

namespace Inilim\Tool\Method\Arr;

\Inilim\Tool\Arr::__include([
    'collapse',
    'accessible',
    'exists',
]);

/**
 * Get an item from an array or object using "dot" notation.
 * @param  mixed  $target
 * @param  string|array|int|null  $key
 * @param  mixed  $default
 * @return mixed
 */
function dataGet($target, $key, $default = null)
{
    if ($key === null) {
        return $target;
    }

    $key = \is_array($key) ? $key : \explode('.', $key);

    foreach ($key as $i => $segment) {
        unset($key[$i]);

        if ($segment === null) {
            return $target;
        }

        if ($segment === '*') {
            if (!\is_array($target)) {
                return $default;
            }

            $result = [];

            foreach ($target as $item) {
                $result[] = \Inilim\Tool\Method\Arr\dataGet($item, $key);
            }

            return \in_array('*', $key) ? \Inilim\Tool\Method\Arr\collapse($result) : $result;
        }

        if (\Inilim\Tool\Method\Arr\accessible($target) && \Inilim\Tool\Method\Arr\exists($target, $segment)) {
            $target = $target[$segment];
        } elseif (\is_object($target) && isset($target->{$segment})) {
            $target = $target->{$segment};
        } else {
            return $default;
        }
    }

    return $target;
}
