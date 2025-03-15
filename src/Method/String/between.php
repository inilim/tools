<?php

namespace Inilim\Tool\Method\String;

/**
 * Get the portion of a string between two given values.
 */
function between(string $subject, string $from, string $to): string
{
    if ($from === '' || $to === '') return $subject;

    return \Inilim\Tool\Method\String\beforeLast(
        \Inilim\Tool\Method\String\after($subject, $from),
        $to
    );
}
