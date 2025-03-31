<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author nette/utils
 * Inserts the contents of the $inserted array into the $array before the $key.
 * If $key is null (or does not exist), it is inserted at the end.
 * @return \Closure(array &$array, string|int|null $key, array $inserted):void
 */
function insertAfter()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException(__FUNCTION__ . '()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (array &$array, $key, array $inserted) {
        if ($key === null || ($offset = \Inilim\Tool\Method\Arr\getKeyOffset($array, $key)) === null) {
            $offset = \sizeof($array) - 1;
        }

        $array = \array_slice($array, 0, $offset + 1, true)
            + $inserted
            + \array_slice($array, $offset + 1, \sizeof($array), true);
    };
}
