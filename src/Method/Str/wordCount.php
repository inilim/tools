<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Get the number of words a string contains.
 */
function wordCount(string $string, ?string $characters = null): int
{
    return \str_word_count($string, 0, $characters);
}
