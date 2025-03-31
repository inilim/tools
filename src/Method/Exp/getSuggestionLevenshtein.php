<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author nette/utils
 * @author inilim
 * Looks for a string from possibilities that is most similar to value, but not the same (for 8-bit encoding).
 * @param  string[]  $possibilities
 * @return string[]
 */
function getSuggestionLevenshtein(array $possibilities, string $value)
{
    $best = [];
    $min = (\strlen($value) / 4 + 1) * 10 + .1;
    foreach ($possibilities as $item) {
        if ($item !== $value && ($len = \levenshtein($item, $value, 10, 11, 10)) <= $min) {
            if ($min !== $len) {
                $best = [];
            }
            $min = $len;
            $best[] = $item;
        }
    }
    return $best;
}
