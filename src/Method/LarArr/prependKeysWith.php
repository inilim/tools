<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Prepend the key names of an associative array.
 *
 * @template TValue
 *
 * @param  array<TValue>  $array
 * @param  string  $prependWith
 * @return array<string, TValue>
 */
function prependKeysWith($array, $prependWith)
{
    return \Inilim\Tool\Method\LarArr\mapWithKeys($array, static fn($item, $key) => [$prependWith . $key => $item]);
}
