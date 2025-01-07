<?php

namespace Inilim\Tool\Method\String;

/**
 * Converts line endings to \n used on Unix-like systems.
 * Line endings are: \n, \r, \r\n, U+2028 line separator, U+2029 paragraph separator.
 */
function unixNewLines(string $s, string $replacement = "\n"): string
{
    return \preg_replace("#\r\n?|\u{2028}|\u{2029}#", $replacement, $s);
}
