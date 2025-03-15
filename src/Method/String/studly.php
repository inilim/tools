<?php

namespace Inilim\Tool\Method\String;

/**
 * Convert a value to studly caps case.
 */
function studly(string $value): string
{
    $words = \explode(' ', \Inilim\Tool\Method\String\replace(['-', '_'], ' ', $value));

    $studly_words = \array_map(
        static fn($word) => \Inilim\Tool\Method\String\ucfirst($word),
        $words
    );

    return \implode($studly_words);
}
