<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

/**
 * @template T of mixed
 * @param T $default
 * @return string|T
 */
function tryDecodeAsString(?string $v, $default = null)
{
    if ($v === null) {
        return $default;
    }
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (\is_string($v)) {
        return $v;
    }
    return $default;
}
