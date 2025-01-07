<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('trim');

/**
 * Remove all "extra" blank space from the given string.
 */
function squish(string $value): string
{
    return \preg_replace('#(\s|\x{3164}|\x{1160})+#u', ' ', trim($value));
}
