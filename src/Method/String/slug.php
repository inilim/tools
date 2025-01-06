<?php

namespace Inilim\Tool\Method\String;

use Inilim\Tool\Str;

Str::__include([
    'ascii',
    'lower',
]);

/**
 * Generate a URL friendly "slug" from a given string.
 * @param  array<string, string>  $dictionary
 */
function slug(string $title, string $separator = '-', ?string $language = 'en', array $dictionary = ['@' => 'at']): string
{
    $title = $language ? \Inilim\Tool\Method\String\ascii($title, $language) : $title;

    // Convert all dashes/underscores into separator
    $flip = $separator === '-' ? '_' : '-';

    $title = \preg_replace('![' . \preg_quote($flip) . ']+!u', $separator, $title);

    // Replace dictionary words
    foreach ($dictionary as $key => $value) {
        $dictionary[$key] = $separator . $value . $separator;
    }

    $title = \str_replace(\array_keys($dictionary), \array_values($dictionary), $title);

    // Remove all characters that are not the separator, letters, numbers, or whitespace
    $title = \preg_replace('![^' . \preg_quote($separator) . '\pL\pN\s]+!u', '', \Inilim\Tool\Method\String\lower($title));

    // Replace all separator characters and whitespace by a single separator
    $title = \preg_replace('![' . \preg_quote($separator) . '\s]+!u', $separator, $title);

    return \trim($title, $separator);
}
