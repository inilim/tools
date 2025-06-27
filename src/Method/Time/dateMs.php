<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * Format a local time/date
 * analog date('pattern');
 * @link https://php.net/manual/en/function.date.php
 * @todo tests
 * @return string|false
 */
function dateMs(string $format, ?int $timestampMs = null)
{
    if ($timestampMs !== null) {
        $timestampMs = \Inilim\Tool\Method\Time\msToSec($timestampMs);
    }
    return \date($format, $timestampMs);
}
