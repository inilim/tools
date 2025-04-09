<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @see /../../tests/Method/Arr/nestedMapTest.php
 * @author inilim
 * @param mixed[] $array
 * @param callable(array $node, int|string|null $keyNode):array $callable
 * @return mixed[]
 */
function nestedMap(array $array, int $depth, callable $callable)
{
    $internal = static function ($internal, &$array, $key, $depth, $callable) {
        /**
         * @var \Closure $internal
         * @var mixed[] $array
         * @var int|string|null $key
         * @var int $depth
         * @var callable $callable
         */
        if ($depth <= 0) {
            return $callable($array, $key);
        }
        foreach ($array as $idx =>  $item) {
            if (\is_array($item)) {
                $array[$idx] = $internal($internal, $item, $idx, ($depth - 1), $callable);
            }
        }
        return $array;
    };

    return $internal->__invoke($internal, $array, null, $depth, $callable);
}
