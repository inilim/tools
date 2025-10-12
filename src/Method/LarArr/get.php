<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get an item from an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|int|null  $key
 * @param  mixed  $default
 * @return mixed
 */
function get($array, $key, $default = null)
{
    if (! \Inilim\Tool\Method\LarArr\accessible($array)) {
        return \Inilim\Tool\Method\Lar\value($default);
    }

    if (\is_null($key)) {
        return $array;
    }

    if (\Inilim\Tool\Method\LarArr\exists($array, $key)) {
        return $array[$key];
    }

    if (! \Inilim\Tool\Method\PF\str_contains($key, '.')) {
        return \Inilim\Tool\Method\Lar\value($default);
    }

    foreach (\explode('.', $key) as $segment) {
        if (\Inilim\Tool\Method\LarArr\accessible($array) && \Inilim\Tool\Method\LarArr\exists($array, $segment)) {
            $array = $array[$segment];
        } else {
            return \Inilim\Tool\Method\Lar\value($default);
        }
    }

    return $array;
}
