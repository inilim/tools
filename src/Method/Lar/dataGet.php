<?php

namespace Inilim\Tool\Method\Lar;

/**
 * Get an item from an array or object using "dot" notation.
 *
 * @param  mixed  $target
 * @param  string|array|int|null  $key
 * @param  mixed  $default
 * @return mixed
 */
function dataGet($target, $key, $default = null)
{
    if (\is_null($key)) {
        return $target;
    }

    $key = \is_array($key) ? $key : \explode('.', $key);

    foreach ($key as $i => $segment) {
        unset($key[$i]);

        if (\is_null($segment)) {
            return $target;
        }

        if ($segment === '*') {
            if ($target instanceof Collection) {
                $target = $target->all();
            } elseif (! \is_iterable($target)) {
                return \Inilim\Tool\Method\Lar\value($default);
            }

            $result = [];

            foreach ($target as $item) {
                $result[] = \Inilim\Tool\Method\Lar\dataGet($item, $key);
            }

            return \in_array('*', $key) ? collapse($result) : $result;
        }

        // var_dump(0 == '\*'); // true php74 EPIC

        if ($segment === '\*') {
            $segment = '*';
        } elseif ($segment === '\{first}') {
            $segment = '{first}';
        } elseif ($segment === '{first}') {
            $segment = \array_key_first(\is_array($target) ? $target : \Inilim\Tool\Method\Arr\from($target));
        } elseif ($segment === '\{last}') {
            $segment = '{last}';
        } elseif ($segment === '{last}') {
            $segment = \array_key_last(\is_array($target) ? $target : \Inilim\Tool\Method\Arr\from($target));
        }

        if (\Inilim\Tool\Method\LarArr\accessible($target) && \Inilim\Tool\Method\LarArr\exists($target, $segment)) {
            $target = $target[$segment];
        } elseif (\is_object($target) && isset($target->{$segment})) {
            $target = $target->{$segment};
        } else {
            return \Inilim\Tool\Method\Lar\value($default);
        }
    }

    return $target;
}
