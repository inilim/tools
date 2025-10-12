<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * @todo tests
 */
function unixMs(): int
{
    $t = \microtime(false);
    return \intval(\substr($t, 11) . \substr($t, 2, 3));
}
