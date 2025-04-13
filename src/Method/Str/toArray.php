<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @author laravel
 * Converts a string to array using the first found separator from the provided list.
 * @param string $string  The input string to convert
 * @param array $separators  List of possible separators to check
 * @return string[]
 */
function toArray(string $string, array $separators = [',', '-', '|', ';', ':', '/', '\\'])
{
    // If string is empty, return empty array early
    if ($string === '') {
        return [];
    }

    $result = [$string];
    foreach ($separators as $separator) {
        if (\Inilim\Tool\Method\Str\_contains($string, $separator)) {
            $result = \explode($separator, $string);
            break; // Exit once we find the first separator
        }
    }

    return $result;
}
