<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * Determine whether the given value is arrayable.
 * @param  mixed  $value
 */
function arrayable($value): bool
{
    // return \is_array($value)
    //     || $value instanceof Arrayable
    //     || $value instanceof \Traversable
    //     || $value instanceof Jsonable
    //     || $value instanceof JsonSerializable;

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $type = \gettype($value);
    if ($type === 'array') {
        /** @var array $value */
        return true;
    } elseif ($type === 'object') {
        /** @var object $value */
        return $value instanceof \Traversable
            || $value instanceof \JsonSerializable
            || \method_exists($value, 'toArray')
            || \method_exists($value, 'toJson');
    }
    return false;
}
