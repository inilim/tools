<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Filter items where the value is not null.
 *
 * @param  array  $array
 * @return array
 */
function whereNotNull($array)
{
    return \Inilim\Tool\Method\LarArr\where($array, static fn($value) => ! \is_null($value));
}
