<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('__startsWith');

/**
 * Remove the given string(s) if it exists at the start of the haystack.
 *
 * @param  string|array  $needle
 */
function chopStart(string $subject, $needle): string
{
    foreach ((array) $needle as $n) {
        if (__startsWith($subject, $n)) {
            return \substr($subject, \strlen($n));
        }
    }

    return $subject;
}
