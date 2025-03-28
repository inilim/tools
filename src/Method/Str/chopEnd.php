<?php

namespace Inilim\Tool\Method\Str;

\Inilim\Tool\Str::__include('__endsWith');

/**
 * Remove the given string(s) if it exists at the end of the haystack.
 * @param  string|array  $needle
 */
function chopEnd(string $subject, $needle): string
{
    foreach ((array) $needle as $n) {
        if (\Inilim\Tool\Method\Str\_endsWith($subject, $n)) {
            return \substr($subject, 0, -\strlen($n));
        }
    }

    return $subject;
}
