<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Set an item on an array or object using dot notation.
 * @template T of array|object
 * @return \Closure(T &$target, string|string[] $key, mixed $value):T
 */
function dataSet()
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());
    return static function (&$target, $key, $value, bool $overwrite = true) {
        $segments = \is_array($key) ? $key : \explode('.', $key);
        $dataSet  = \Inilim\Tool\Method\Arr\dataSet();

        if (($segment = \array_shift($segments)) === '*') {
            if (!\Inilim\Tool\Method\Arr\accessible($target)) {
                $target = [];
            }

            if ($segments) {
                foreach ($target as &$inner) {
                    $dataSet($inner, $segments, $value, $overwrite);
                }
            } elseif ($overwrite) {
                foreach ($target as &$inner) {
                    $inner = $value;
                }
            }
        } elseif (\Inilim\Tool\Method\Arr\accessible($target)) {
            if ($segments) {
                if (!\Inilim\Tool\Method\Arr\exists($target, $segment)) {
                    $target[$segment] = [];
                }

                $dataSet($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite || !\Inilim\Tool\Method\Arr\exists($target, $segment)) {
                $target[$segment] = $value;
            }
        } elseif (\is_object($target)) {
            if ($segments) {
                if (!isset($target->{$segment})) {
                    $target->{$segment} = [];
                }

                $dataSet($target->{$segment}, $segments, $value, $overwrite);
            } elseif ($overwrite || !isset($target->{$segment})) {
                $target->{$segment} = $value;
            }
        } else {
            $target = [];

            if ($segments) {
                $dataSet($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite) {
                $target[$segment] = $value;
            }
        }

        return $target;
    };
}
