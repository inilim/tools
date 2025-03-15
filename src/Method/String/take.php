<?php

namespace Inilim\Tool\Method\String;

/**
 * Take the first or last {$limit} characters of a string.
 */
function take(string $string, int $limit): string
{
    if ($limit < 0) {
        return \Inilim\Tool\Method\String\substr($string, $limit);
    }

    return \Inilim\Tool\Method\String\substr($string, 0, $limit);
}
