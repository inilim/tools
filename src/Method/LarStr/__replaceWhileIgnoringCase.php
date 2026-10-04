<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Replace the given value in the given string regardless of case.
 *
 * @param  string|string[]  $search
 * @param  string|string[]  $replace
 * @param  string|string[]  $subject
 * @return string|string[]
 */
function __replaceWhileIgnoringCase($search, $replace, $subject)
{
    if (! \is_array($search) && \is_array($replace)) {
        return \str_ireplace($search, $replace, $subject);
    }

    $searches = \is_array($search) ? \array_values($search) : [$search];

    // @deps(\Inilim\Tool\Method\LarStr\isAscii)
    if (\Inilim\Tool\Method\PF\array_all($searches, '\Inilim\Tool\Method\LarStr\isAscii')) {
        return \str_ireplace($search, $replace, $subject);
    }

    $replacements = \is_array($replace)
        ? \array_values($replace)
        : \array_fill(0, \count($searches), $replace);

    foreach ([...$searches, ...$replacements, ...(array) $subject] as $value) {
        if (! \preg_match('//u', (string) $value)) {
            return \str_ireplace($search, $replace, $subject);
        }
    }

    foreach ($searches as $index => $term) {
        $term = (string) $term;

        if ($term === '') {
            continue;
        }

        $replacement = (string) ($replacements[$index] ?? '');

        $subject = \Inilim\Tool\Method\LarStr\isAscii($term)
            ? \str_ireplace($term, $replacement, $subject)
            : \preg_replace_callback('/' . \preg_quote($term, '/') . '/iu', static fn() => $replacement, $subject);
    }

    return $subject;
}
