<?php

namespace Inilim\Tool\Method\Json;

/**
 * @param mixed $v
 */
function isJsonSerializable($v, int $flags = 0, int $depth = 512): bool
{
    return \Inilim\Tool\Method\Json\tryEncode($v, $flags, $depth) === null ? false : true;
}
