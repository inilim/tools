<?php

namespace Inilim\Tool\Method\Time;

/**
 * @todo tests
 * @return int
 */
function unixMs()
{
    $timestamp = \microtime(false);
    return \intval(\substr($timestamp, 11), 10) * 1000 + \intval(\substr($timestamp, 2, 3), 10);
}
