<?php

namespace Inilim\Tool\Method\ID;

/**
 * @return string
 */
function uuidv7()
{
    $uhex  = \substr(\str_pad(\dechex(\Inilim\Tool\Method\Time\unixMs()), 12, '0', \STR_PAD_LEFT), -12);
    $uhex .= \bin2hex(\random_bytes(10));
    return \Inilim\Tool\Method\ID\uuidFromHex($uhex, 7);
}
