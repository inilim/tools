<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include([
    'accessible',
    'value',
    'exists',
]);

/**
 * Get an item from an array using "dot" notation.
 * @template D
 *
 * @param \ArrayAccess|array $array
 * @param string|int|null $key
 * @param D $default
 * @return mixed|D
 */
function get($array, $key, $default = null)
{
    if (!\Inilim\Method\Arr\accessible($array)) {
        return \Inilim\Method\Arr\value($default);
    }

    if ($key === null) {
        return $array;
    }

    if (\Inilim\Method\Arr\exists($array, $key)) {
        return $array[$key];
    }

    if (\strpos(\strval($key), '.') === false) {
        return $array[$key] ?? \Inilim\Method\Arr\value($default);
    }

    foreach (\explode('.', \strval($key)) as $segment) {
        if (\Inilim\Method\Arr\accessible($array) && \Inilim\Method\Arr\exists($array, $segment)) {
            $array = $array[$segment];
        } else {
            return \Inilim\Method\Arr\value($default);
        }
    }

    return $array;
}
