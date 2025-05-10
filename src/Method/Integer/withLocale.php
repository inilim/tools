<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Execute the given callback using the given locale.
 * @return mixed
 */
function withLocale(string $locale, callable $callback)
{
    $state          = \Inilim\Tool\Method\Integer\__state();
    $previousLocale = $state->locale;
    $state->locale  = $locale;
    $result         = $callback();
    $state->locale  = $previousLocale;
    return $result;
}
