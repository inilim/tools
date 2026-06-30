<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @deprecated LarStr
 * Cap a string with a single instance of a given value.
 */
function finish(string $value, string $cap): string
{
    return \preg_replace('/(?:' . \preg_quote($cap, '/') . ')+$/u', '', $value) . $cap;
}
