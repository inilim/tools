<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @author Laravel
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
    if (!\Inilim\Tool\Method\LarArr\accessible($array)) {
        return \Inilim\Tool\Method\Lar\value($default);
    }

    if ($key === null) {
        return $array;
    }

    if (\Inilim\Tool\Method\LarArr\exists($array, $key)) {
        return $array[$key];
    }

    if (\strpos(\strval($key), '.') === false) {
        return $array[$key] ?? \Inilim\Tool\Method\Lar\value($default);
    }

    foreach (\explode('.', \strval($key)) as $segment) {
        if (\Inilim\Tool\Method\LarArr\accessible($array) && \Inilim\Tool\Method\LarArr\exists($array, $segment)) {
            $array = $array[$segment];
        } else {
            return \Inilim\Tool\Method\Lar\value($default);
        }
    }

    return $array;
}
