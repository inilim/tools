<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author nette/utils
 * Looks for a string from possibilities that is most similar to value, but not the same (for 8-bit encoding).
 * @param  string[]  $possibilities
 * @return ?string
 */
function getSuggestionLevenshtein(array $possibilities, string $value)
{
    $best = null;
    $min = (\strlen($value) / 4 + 1) * 10 + .1;
    foreach ($possibilities as &$item) {
        if ($item !== $value && ($len = \levenshtein($item, $value, 10, 11, 10)) < $min) {
            $min = $len;
            $best = $item;
        }
    }

    return $best;
}
