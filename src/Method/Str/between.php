<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Get the portion of a string between two given values.
 */
function between(string $subject, string $from, string $to): string
{
    if ($from === '' || $to === '') return $subject;

    return \Inilim\Tool\Method\Str\beforeLast(
        \Inilim\Tool\Method\Str\after($subject, $from),
        $to
    );
}
