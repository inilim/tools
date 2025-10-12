<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Determine whether the given value is arrayable.
 * @build_skip
 *
 * @param  mixed  $value
 * @return bool
 */
function arrayable($value)
{
    return \is_array($value)
        || $value instanceof Arrayable
        || $value instanceof \Traversable
        || $value instanceof Jsonable
        || $value instanceof JsonSerializable;
}
