<?php

namespace Inilim\Method\String;

/**
 * Remove all whitespace from both ends of a string.
 * @return string
 */
function trim(string $value, ?string $charlist = null)
{
    if ($charlist === null) {
        return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}]+|[\s\x{FEFF}\x{200B}\x{200E}]+$~u', '', $value) ?? \trim($value);
    }

    return \trim($value, $charlist);
}
