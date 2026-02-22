<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Convert the given string to Base64 encoding.
 *
 * @param  string  $string
 * @return ($string is '' ? '' : string)
 */
function toBase64($string): string
{
    return \base64_encode($string);
}
