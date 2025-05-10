<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Get the default locale.
 */
function defaultLocale(): string
{
    return \Inilim\Tool\Method\Integer\__state()->locale;
}
