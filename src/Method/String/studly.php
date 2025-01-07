<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include([
    'replace',
    'ucfirst',
]);

/**
 * Convert a value to studly caps case.
 */
function studly(string $value): string
{
    $words = \explode(' ', replace(['-', '_'], ' ', $value));

    $studly_words = \array_map(
        static fn($word) => ucfirst($word),
        $words
    );

    return \implode($studly_words);
}
