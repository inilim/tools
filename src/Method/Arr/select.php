<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Select an array of values from an array.
 *
 * @param  array  $array
 * @param  array|string  $keys
 * @return array
 */
function select(array $array, $keys)
{
    $keys = \Inilim\Tool\Method\Arr\wrap($keys);

    return \Inilim\Tool\Method\Arr\map($array, static function ($item) use ($keys) {
        $result = [];

        foreach ($keys as $key) {
            if ($key === null) {
                continue;
            }
            if (\Inilim\Tool\Method\Arr\accessible($item) && \Inilim\Tool\Method\Arr\exists($item, $key)) {
                $result[$key] = $item[$key];
            } elseif (\is_object($item) && isset($item->{$key})) {
                $result[$key] = $item->{$key};
            }
        }

        return $result;
    });
}
