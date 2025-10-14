<?php

function wordCount(string $string, ?string $characters = null): int
{
    if ($characters === null) {
        return \str_word_count($string, 0);
    }
    return \str_word_count($string, 0, $characters);
}

print_r(wordCount('мама'));

// $a = new \DivisionByZeroError;
// print_r($a);
