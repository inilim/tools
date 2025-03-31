<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author nette/utils
 * Copies the elements of the $array array to the $object object and then returns it.
 * @template T of object
 * @param  T  $object
 * @return T
 */
function toObj(iterable $array, object $object)
{
    foreach ($array as $k => &$v) {
        $object->$k = $v;
    }

    return $object;
}
