<?php

namespace Inilim\Tool;

class Sql
{
        /**
 * @build_skip
 * Sanitizes a +string+ so that it is safe to use within an SQL
 * LIKE statement. This method uses +escape_character+ to escape all
 * occurrences of itself, "_" and "%".
 */
    static function sanitizeSqlLike(string $string, string $escapeChar = '\\'): string {}

    }