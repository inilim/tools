<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Convert a value to studly caps case.
 *
 * @param  string  $value
 * @param  bool  $normalize  When true, all-uppercase words (e.g. acronyms) are lowercased before conversion so "CBOR" becomes "Cbor" instead of "CBOR".
 * @return ($value is '' ? '' : string)
 */
function studly($value, bool $normalize = false)
{
    if ($normalize) {
        $value = \preg_replace_callback(
            '/(^|[-_ \s])([A-Z]+)(?=[-_ \s]|$)/u',
            static fn($m) => $m[1] . \Inilim\Tool\Method\LarStr\lower($m[2]),
            $value
        );
    }

    $key = $value;

    $studlyCache = &\Inilim\Tool\Method\LarStr\__state()->studlyCache;

    if (isset($studlyCache[$key])) {
        return $studlyCache[$key];
    }

    $words = \preg_split('/\s+/u', \Inilim\Tool\Method\LarStr\replace(['-', '_'], ' ', $value), -1, \PREG_SPLIT_NO_EMPTY);

    $studlyWords = \array_map(static fn($word) => \Inilim\Tool\Method\LarStr\ucfirst($word), $words);

    return $studlyCache[$key] = \implode('', $studlyWords);
}
