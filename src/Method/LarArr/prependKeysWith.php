<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Prepend the key names of an associative array.
 *
 * @param array $array
 * @param string $prependWith
 * @return array
 */
function prependKeysWith($array, $prependWith)
{
    return \Inilim\Tool\Method\LarArr\mapWithKeys($array, static fn($item, $key) => [$prependWith . $key => $item]);
}
