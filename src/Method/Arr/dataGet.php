<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Get an item from an array or object using "dot" notation.
 * @param array|object $target
 * @param string|array|int|null $key
 * @param mixed $default
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
            if (!\is_iterable($target)) {
                return \Inilim\Tool\Method\Arr\value($default);
            }

            $result = [];

            foreach ($target as $item) {
                $result[] = \Inilim\Tool\Method\Arr\dataGet($item, $key);
            }

            return \in_array('*', $key) ? \Inilim\Tool\Method\Arr\collapse($result) : $result;
        }

        switch ($segment) {
            case '\*':
                $segment = '*';
                break;
            case '\{first}':
                $segment = '{first}';
                break;
            case '{first}':
                $segment = \array_key_first(\is_array($target) ? $target : \Inilim\Tool\Method\Arr\getArrayableItems($target));
                break;
            case '\{last}':
                $segment = '{last}';
                break;
            case '{last}':
                $segment = \array_key_last(\is_array($target) ? $target : \Inilim\Tool\Method\Arr\getArrayableItems($target));
                break;
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
