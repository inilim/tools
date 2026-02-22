<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Replace the patterns matching the given regular expression.
 *
 * @param  string|string[]  $pattern
 * @param  (\Closure(array): string)|string[]|string  $replace
 * @param  string[]|string  $subject
 * @param  int  $limit
 * @return ($subject is array ? string[]|null : string|null)
 */
function replaceMatches($pattern, $replace, $subject, int $limit = -1)
{
    if ($replace instanceof \Closure) {
        return \preg_replace_callback($pattern, $replace, $subject, $limit);
    }

    return \preg_replace($pattern, $replace, $subject, $limit);
}
