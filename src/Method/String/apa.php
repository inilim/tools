<?php

namespace Inilim\Method\String;

use Inilim\Tool\Str;

Str::__include('__contains');

/**
 * Convert the given string to APA-style title case.
 *
 * See: https://apastyle.apa.org/style-grammar-guidelines/capitalization/title-case
 */
function apa(string $value): string
{
    $minorWords = [
        'and',
        'as',
        'but',
        'for',
        'if',
        'nor',
        'or',
        'so',
        'yet',
        'a',
        'an',
        'the',
        'at',
        'by',
        'for',
        'in',
        'of',
        'off',
        'on',
        'per',
        'to',
        'up',
        'via',
    ];

    $endPunctuation = ['.', '!', '?', ':', '—', ','];

    $words = \preg_split('/\s+/', $value, -1, \PREG_SPLIT_NO_EMPTY);

    $words[0] = \ucfirst(\mb_strtolower($words[0]));

    for ($i = 0; $i < \sizeof($words); $i++) {
        $lowercaseWord = \mb_strtolower($words[$i]);

        if (\Inilim\Method\String\__contains($lowercaseWord, '-')) {
            $hyphenatedWords = \explode('-', $lowercaseWord);

            $hyphenatedWords = \array_map(function ($part) use ($minorWords) {
                return (\in_array($part, $minorWords) && \mb_strlen($part) <= 3) ? $part : \ucfirst($part);
            }, $hyphenatedWords);

            $words[$i] = \implode('-', $hyphenatedWords);
        } else {
            if (
                \in_array($lowercaseWord, $minorWords) &&
                \mb_strlen($lowercaseWord) <= 3 &&
                !($i === 0 || \in_array(\mb_substr($words[$i - 1], -1), $endPunctuation))
            ) {
                $words[$i] = $lowercaseWord;
            } else {
                $words[$i] = \ucfirst($lowercaseWord);
            }
        }
    }

    return \implode(' ', $words);
}
