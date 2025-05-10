<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * Set the default locale.
 * @return void
 */
function useLocale(string $locale)
{
    \Inilim\Tool\Method\Integer\__state()->locale = $locale;
}
