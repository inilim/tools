<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * @todo tests
 */
function unixMsFromGlobals(): int
{
    $rtf = \Inilim\Tool\Method\Arr\float($_SERVER, 'REQUEST_TIME_FLOAT');
    return \intval(\intval($rtf) . '000') + \intval(\substr((string)$rtf, 11, 3));
}
