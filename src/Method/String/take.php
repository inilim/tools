<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('substr');

/**
 * Take the first or last {$limit} characters of a string.
 */
function take(string $string, int $limit): string
{
    if ($limit < 0) {
        return substr($string, $limit);
    }

    return substr($string, 0, $limit);
}
