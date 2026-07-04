<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author nette/utils
 * 
 * Returns reference to array item. If the index does not exist, new one is created with value null.
 * @template T
 * @return \Closure(array<T>,array-key|array-key[]):?T
 * @throws \InvalidArgumentException if traversed item is not an array
 */
function getRef(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function & (array &$array, $key) {
        foreach (\is_array($key) ? $key : [$key] as $k) {
            if (\is_array($array) || $array === null) {
                $array = &$array[$k];
            } else {
                throw new \InvalidArgumentException('Traversed item is not an array.');
            }
        }

        return $array;
    };
}
