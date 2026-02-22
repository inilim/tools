<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Decode the given Base64 encoded string.
 *
 * @param  string  $string
 * @param  bool  $strict
 * @return ($strict is true ? ($string is '' ? '' : string|false) : ($string is '' ? '' : string))
 */
function fromBase64($string, $strict = false)
{
    return \base64_decode($string, $strict);
}
