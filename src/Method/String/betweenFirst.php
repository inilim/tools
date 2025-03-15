<?php

namespace Inilim\Tool\Method\String;

/**
 * Get the smallest possible portion of a string between two given values.
 */
function betweenFirst(string $subject, string $from, string $to): string
{
    if ($from === '' || $to === '') {
        return $subject;
    }

    return \Inilim\Tool\Method\String\before(
        \Inilim\Tool\Method\String\after($subject, $from),
        $to
    );
}
