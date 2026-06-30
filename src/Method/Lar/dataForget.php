<?php

namespace Inilim\Tool\Method\Lar;

/**
 * Remove / unset an item from an array or object using "dot" notation.
 * @return \Closure(mixed $target, string|array|int|null $key):mixed
 */
function dataForget(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    $forget = \Inilim\Tool\Method\LarArr\forget();
    $data_forget = static function (&$target, $key) use ($forget) {
        $data_forget = \Inilim\Tool\Method\Lar\dataForget();

        $segments = \is_array($key) ? $key : \explode('.', $key);

        if (($segment = \array_shift($segments)) === '*' && \Inilim\Tool\Method\LarArr\accessible($target)) {
            if ($segments) {
                foreach ($target as &$inner) {
                    $data_forget($inner, $segments);
                }
            }
        } elseif (\Inilim\Tool\Method\LarArr\accessible($target)) {
            if ($segments && \Inilim\Tool\Method\LarArr\exists($target, $segment)) {
                $data_forget($target[$segment], $segments);
            } else {
                $forget($target, $segment);
            }
        } elseif (\is_object($target)) {
            if ($segments && isset($target->{$segment})) {
                $data_forget($target->{$segment}, $segments);
            } elseif (isset($target->{$segment})) {
                unset($target->{$segment});
            }
        }

        return $target;
    };

    return $data_forget;
}


// INFO
// функция работает в двух режимах, если передать ключ строку, то функция корректно отработает звездочки, если передать ключи массивом, то обработка звездочек не будет