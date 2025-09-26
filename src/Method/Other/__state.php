<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @internal Inilim\Tool\Method\Other
 *
 * @return \Inilim\Internal\OtherState
 */
function __state(): object
{
    static $o = null;
    return $o ?? new class {
        /**
         * last error.
         */
        var ?array $error = null;
    };
}
