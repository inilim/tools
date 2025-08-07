<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Remove all whitespace from both ends of a string.
 */
function trim(string $value, ?string $charlist = null): string
{
    // nette/utils
    // " \t\n\r\0\x0B\u{A0}\u{2000}\u{2001}\u{2002}\u{2003}\u{2004}\u{2005}\u{2006}\u{2007}\u{2008}\u{2009}\u{200A}\u{200B}\u{2028}\u{3000}";
    if ($charlist === null) {
        $trimDefaultCharacters = \preg_quote(" \n\r\t\v\0");

        return \preg_replace(
            '~^[\s\x{FEFF}\x{200B}\x{200E}' . $trimDefaultCharacters . ']+|[\s\x{FEFF}\x{200B}\x{200E}' . $trimDefaultCharacters . ']+$~u',
            '',
            $value
        ) ?? \trim($value);
    }

    return \trim($value, $charlist);
}
