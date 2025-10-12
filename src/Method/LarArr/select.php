<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Select an array of values from an array.
 *
 * @param  array  $array
 * @param  array|string  $keys
 * @return array
 */
function select($array, $keys)
{
    $keys = \Inilim\Tool\Method\LarArr\wrap($keys);

    return \Inilim\Tool\Method\LarArr\map($array, static function ($item) use ($keys) {
        $result = [];

        foreach ($keys as $key) {
            if (\Inilim\Tool\Method\LarArr\accessible($item) && \Inilim\Tool\Method\LarArr\exists($item, $key)) {
                $result[$key] = $item[$key];
            } elseif (\is_object($item) && isset($item->{$key})) {
                $result[$key] = $item->{$key};
            }
        }

        return $result;
    });
}
