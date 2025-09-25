<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\ID;

/**
 * @throws \InvalidArgumentException
 */
function uuidToBytes(string $uuid): string
{
    $spl = \Inilim\Tool\Method\ID\uuidSplit($uuid);
    if ($spl === null) {
        throw new \InvalidArgumentException('Invalid UUID string: ' . $uuid);
    }
    return \pack('H*', \strtolower(\implode('', $spl)));
}
