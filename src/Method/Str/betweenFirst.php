<?php

namespace Inilim\Tool\Method\Str;

/**
 * Get the smallest possible portion of a string between two given values.
 */
function betweenFirst(string $subject, string $from, string $to): string
{
    if ($from === '' || $to === '') {
        return $subject;
    }

    return \Inilim\Tool\Method\Str\before(
        \Inilim\Tool\Method\Str\after($subject, $from),
        $to
    );
}
