<?php

namespace Inilim\Tool\Method\Time;

/**
 * @todo tests
 */
function unixMs(): int
{
    $timestamp = \microtime(false);
    return \intval(\substr($timestamp, 11), 10) * 1000 + \intval(\substr($timestamp, 2, 3), 10);
}
