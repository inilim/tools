<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Get the default currency.
 */
function defaultCurrency(): string
{
    return \Inilim\Tool\Method\Integer\__state()->currency;
}
