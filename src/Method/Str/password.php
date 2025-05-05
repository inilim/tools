<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Generate a random, secure password.
 */
function password(
    int $length   = 32,
    bool $letters = true,
    bool $numbers = true,
    bool $symbols = true,
    bool $spaces  = false
): string {
    $characters = [];
    $password = '';

    if ($letters) {
        $characters[] = \Inilim\Tool\Method\Data\latinAlphabetAsClosure(false)->__invoke();
        $characters[] = \Inilim\Tool\Method\Data\latinAlphabetAsClosure(true)->__invoke();
    }
    if ($numbers) {
        $characters[] = \Inilim\Tool\Method\Data\numbersAsClosure()->__invoke();
    }
    if ($symbols) {
        $characters[] = \Inilim\Tool\Method\Data\symbolsAsClosure()->__invoke();
    }
    if ($spaces) {
        $characters[] = [' '];
    }

    foreach ($characters as $items) {
        $password .= $items[\random_int(0, \sizeof($items) - 1)];
    }

    $partsCount       = \sizeof($characters);
    $characters       = \array_merge([], ...$characters);
    $charactersLength = \sizeof($characters) - 1;
    $length           = $length - $partsCount;

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[\random_int(0, $charactersLength)];
    }

    return \str_shuffle($password);
}
