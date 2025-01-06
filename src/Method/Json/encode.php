<?php

namespace Inilim\Tool\Method\Json;

/**
 * @param mixed $value
 * @return string|false
 */
function encode($value, int $flags = 0, int $depth = 512)
{
    // @phpstan-ignore-next-line
    return \json_encode($value, $flags, $depth);
}
