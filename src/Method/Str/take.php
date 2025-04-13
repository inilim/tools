<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Take the first or last {$limit} characters of a string.
 */
function take(string $string, int $limit): string
{
    if ($limit < 0) {
        return \Inilim\Tool\Method\Str\substr($string, $limit);
    }

    return \Inilim\Tool\Method\Str\substr($string, 0, $limit);
}
