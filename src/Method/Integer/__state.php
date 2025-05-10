<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * @internal Inilim\Tool\Method\Integer
 * @return \Inilim\Internal\IntegerState
 */
function __state()
{
    static $o = null;
    return $o ?? new class() {
        /**
         * The current default locale.
         */
        var string $locale = 'en';

        /**
         * The current default currency.
         */
        var string $currency = 'USD';
    };
}
