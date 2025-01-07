<?php

namespace Inilim\Tool\Method\Json;

use Inilim\Tool\Json;

Json::__include('tryEncode');

/**
 * @param mixed $value
 * @return bool
 */
function isJsonSerializable($value, int $flags = 0, int $depth = 512)
{
    return tryEncode($value, $flags, $depth) === null ? false : true;
}
