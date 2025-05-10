<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Split the given number into pairs of min/max values.
 * @param  int|float  $to
 * @param  int|float  $by
 * @param  int|float  $start
 * @param  int|float  $offset
 * @return array
 */
function pairs($to, $by, $start = 0, $offset = 1): array
{
    $output = [];

    for ($lower = $start; $lower < $to; $lower += $by) {
        $upper = $lower + $by - $offset;

        if ($upper > $to) {
            $upper = $to;
        }

        $output[] = [$lower, $upper];
    }

    return $output;
}
