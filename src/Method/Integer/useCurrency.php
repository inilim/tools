<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Set the default currency.
 * @return void
 */
function useCurrency(string $currency)
{
    \Inilim\Tool\Method\Integer\__state()->currency = $currency;
}
