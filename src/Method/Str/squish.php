<?php

namespace Inilim\Tool\Method\Str;

/**
 * Remove all "extra" blank space from the given string.
 * @return string
 */
function squish(string $value)
{
    return \preg_replace('#(\s|\x{3164}|\x{1160})+#u', ' ', \Inilim\Tool\Method\Str\trim($value));
}
