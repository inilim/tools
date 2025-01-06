<?php

namespace Inilim\Method\String;

use Inilim\Tool\Str;

Str::__include('trim');

/**
 * Remove all "extra" blank space from the given string.
 */
function squish(string $value): string
{
    return \preg_replace('#(\s|\x{3164}|\x{1160})+#u', ' ', \Inilim\Method\String\trim($value));
}
