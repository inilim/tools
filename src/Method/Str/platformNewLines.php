<?php

namespace Inilim\Tool\Method\Str;

/**
 * Converts line endings to platform-specific, i.e. \r\n on Windows and \n elsewhere.
 * Line endings are: \n, \r, \r\n, U+2028 line separator, U+2029 paragraph separator.
 */
function platformNewLines(string $s): string
{
    return \Inilim\Tool\Method\Str\unixNewLines($s, \PHP_EOL);
}
