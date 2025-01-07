<?php

namespace Inilim\Tool\Method\String;

/**
 * Replace the patterns matching the given regular expression.
 * @param \Closure|string $replace
 * @param string[]|string $subject
 * @return string|string[]|null
 */
function replaceMatches(string $pattern, $replace, $subject, int $limit = -1)
{
    if ($replace instanceof \Closure) {
        return \preg_replace_callback($pattern, $replace, $subject, $limit);
    }

    return \preg_replace($pattern, $replace, $subject, $limit);
}
