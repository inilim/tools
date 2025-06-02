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
function nestedMap(array $array, int $depth, callable $callable): array
{
    $internal = static function (array &$array, $key, int $depth, callable $callable) use (&$internal): array {
        /**
         * @var \Closure $internal
         * @var int|string|null $key
         */
        if ($depth <= 0) {
            return $callable($array, $key);
        }
        foreach ($array as $idx =>  $item) {
            if (\is_array($item)) {
                $array[$idx] = $internal($item, $idx, ($depth - 1), $callable);
            }
        }
        return $array;
    };

    return $internal($array, null, $depth, $callable);
}
