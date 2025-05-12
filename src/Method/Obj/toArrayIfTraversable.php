<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @deprecated use Arr::from
 * @author mohammadrasoulasghari <https://github.com/mohammadrasoulasghari>
 * Convert a Traversable to an array, or return the original value if not Traversable.
 * @template T of mixed
 * @param T $value
 * @return ($value is \Traversable ? array : T)
 */
function toArrayIfTraversable($value)
{
    if ($value instanceof \Traversable) {
        return \iterator_to_array($value);
    }

    return $value;
}
