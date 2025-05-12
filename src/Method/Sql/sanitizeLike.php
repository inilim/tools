<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Sql;

/**
 * @build_skip
 * Sanitizes a +string+ so that it is safe to use within an SQL
 * LIKE statement. This method uses +escape_character+ to escape all
 * occurrences of itself, "_" and "%".
 */
function sanitizeSqlLike(string $string, string $escapeChar = '\\'): string
{
    if (str_contains($string, $escapeChar) && $escapeChar !== '%' && $escapeChar !== '_') {
        $string = \str_replace($escapeChar, $escapeChar . $escapeChar, $string);
    }

    return \preg_replace('/(?=[%_])/', $escapeChar, $string);
}
