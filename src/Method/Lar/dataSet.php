<?php

namespace Inilim\Tool\Method\Lar;

/**
 * Set an item on an array or object using dot notation.
 *
 * @return \Closure(mixed $target, string|array $key, mixed $value, bool $overwrite = true):mixed
 */
function dataSet(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (&$target, $key, $value, $overwrite = true) {
        $segments = \is_array($key) ? $key : \explode('.', $key);

        if (($segment = \array_shift($segments)) === '*') {
            if (! \Inilim\Tool\Method\LarArr\accessible($target)) {
                $target = [];
            }

            if ($segments) {
                foreach ($target as &$inner) {
                    \Inilim\Tool\Method\Lar\dataSet()($inner, $segments, $value, $overwrite);
                }
            } elseif ($overwrite) {
                foreach ($target as &$inner) {
                    $inner = $value;
                }
            }
        } elseif (\Inilim\Tool\Method\LarArr\accessible($target)) {
            if ($segments) {
                if (! \Inilim\Tool\Method\LarArr\exists($target, $segment)) {
                    $target[$segment] = [];
                }

                \Inilim\Tool\Method\Lar\dataSet()($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite || ! \Inilim\Tool\Method\LarArr\exists($target, $segment)) {
                $target[$segment] = $value;
            }
        } elseif (\is_object($target)) {
            if ($segments) {
                if (! isset($target->{$segment})) {
                    $target->{$segment} = [];
                }

                \Inilim\Tool\Method\Lar\dataSet()($target->{$segment}, $segments, $value, $overwrite);
            } elseif ($overwrite || ! isset($target->{$segment})) {
                $target->{$segment} = $value;
            }
        } else {
            $target = [];

            if ($segments) {
                \Inilim\Tool\Method\Lar\dataSet()($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite) {
                $target[$segment] = $value;
            }
        }

        return $target;
    };
}
