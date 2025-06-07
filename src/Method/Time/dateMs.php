<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * Format a local time/date
 * @todo tests
 * @return string|false
 */
function dateMs(string $format, ?int $timestampMs = null)
{
    if ($timestampMs !== null) {
        $timestampMs = \intval($timestampMs * 0.001);
    }
    return \date($format, $timestampMs);
}
