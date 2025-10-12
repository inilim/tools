<?php

namespace Inilim\Tool\Method\Lar;

/**
 * Remove / unset an item from an array or object using "dot" notation.
 * @return \Closure(mixed $target, string|array|int|null $key):mixed
 */
function dataForget(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (&$target, $key) {
        $segments = \is_array($key) ? $key : \explode('.', $key);

        if (($segment = \array_shift($segments)) === '*' && \Inilim\Tool\Method\LarArr\accessible($target)) {
            if ($segments) {
                foreach ($target as &$inner) {
                    \Inilim\Tool\Method\Lar\dataForget()($inner, $segments);
                }
            }
        } elseif (\Inilim\Tool\Method\LarArr\accessible($target)) {
            if ($segments && \Inilim\Tool\Method\LarArr\exists($target, $segment)) {
                \Inilim\Tool\Method\Lar\dataForget()($target[$segment], $segments);
            } else {
                \Inilim\Tool\Method\LarArr\forget()($target, $segment);
            }
        } elseif (\is_object($target)) {
            if ($segments && isset($target->{$segment})) {
                \Inilim\Tool\Method\Lar\dataForget()($target->{$segment}, $segments);
            } elseif (isset($target->{$segment})) {
                unset($target->{$segment});
            }
        }

        return $target;
    };
}
