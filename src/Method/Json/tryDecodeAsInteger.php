<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

/**
 * @template T of mixed
 * @param T $default
 * @return int|T
 */
function tryDecodeAsInteger(?string $v, $default = null)
{
    if ($v === null) {
        return $default;
    }
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (\is_int($v)) {
        return $v;
    }
    return $default;
}
