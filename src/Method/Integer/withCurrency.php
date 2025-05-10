<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Execute the given callback using the given currency.
 * @return mixed
 */
function withCurrency(string $currency, callable $callback)
{
    $state            = \Inilim\Tool\Method\Integer\__state();
    $previousCurrency = $state->currency;
    $state->currency  = $currency;
    $result           = $callback();
    $state->currency  = $previousCurrency;
    return $result;
}
