<?php

namespace Inilim\Tool\Method\Str;

/**
 * Convert a value to studly caps case.
 */
function studly(string $value): string
{
    $words = \explode(' ', \Inilim\Tool\Method\Str\replace(['-', '_'], ' ', $value));

    $studly_words = \array_map(
        static fn($word) => \Inilim\Tool\Method\Str\ucfirst($word),
        $words
    );

    return \implode($studly_words);
}
