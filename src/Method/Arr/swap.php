<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author gigabites19 <https://github.com/gigabites19>
 * Swap places of items in an array.
 * @return \Closure(array &$array, string|int $keyOne, string|int $keyTwo):void
 */
function swap(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (array &$array, $keyOne, $keyTwo) {
        /**
         * @var string|int $keyOne
         * @var string|int $keyTwo
         */
        if (! \Inilim\Tool\Method\Arr\exists($array, $keyOne) || ! \Inilim\Tool\Method\Arr\exists($array, $keyTwo)) {
            throw new \InvalidArgumentException('One or both keys do not exist in the array.');
        }

        // Short-circuit the method if both keys are the same.
        if ($keyOne === $keyTwo) {
            return;
        }

        [$array[$keyOne], $array[$keyTwo]] = [$array[$keyTwo], $array[$keyOne]];
    };
}
